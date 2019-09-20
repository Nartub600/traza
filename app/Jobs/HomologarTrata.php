<?php

namespace App\Jobs;

use App\Traza;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HomologarTrata implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $numeroExpediente = $data['numeroExpediente'];

        $this->bloquearExpediente($numeroExpediente);
        $documentacion = $this->consultarDocumentacion($numeroExpediente);
        $resultado = $this->revisarDocumentacion($documentacion);

        // no se encuentra Certificado ni LCM
        if (!$resultado['ok']) {
            $this->desbloquearExpediente();
            $this->generarDocumentoRechazo();
            $this->vincularDocumento();
            $this->paseABuzonDNI();

            return response('La documentación no es válida');
        }

        // si es $resultado['ok'] viene con ['tipo'] y ['data']
        switch ($resultado['tipo']) {
            case 'chas':
                $verificacion = $this->verificarDatosCHAS($resultado['data']);
                if (!$verificacion['ok']) {
                    $this->generarDocumentoRechazo();
                    $this->vincularDocumento();
                    $this->paseAGuardaTemporal();

                    return response('Los datos no son válidos');
                }

                switch ($verificacion['nacional']) {
                    case true:
                        $this->generarCHAS($tramite);
                        $this->generarDocumentoHomologación();
                        $this->vincularDocumento();
                        $this->paseAGuardaTemporal();
                    break;
                    case false:
                        $this->desbloquearExpediente();
                        $this->paseAINTI();
                        $this->notificacionAINTI();
                    break;
                }
            break;
            case 'cape':
                $verificacion = $this->verificarDatosCAPE($resultado['data']);
                if (!$verificacion['ok']) {
                    $this->generarDocumentoRechazo();
                    $this->vincularDocumento();
                    $this->paseAGuardaTemporal();

                    return response('Los datos no son válidos');
                }

                $this->generarCAPE($tramite);
                $this->generarDocumentoHomologación();
                $this->vincularDocumento();
                $this->paseAGuardaTemporal();
            break;
        }

        // $traza = new Traza();
        // $traza->number = $this->data['number'];
        // $traza->save();
    }
}
