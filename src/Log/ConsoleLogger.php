<?php

/**
 * Logger para a tela do console.
 */
namespace CPAD\Log;

/**
 * Exibe o log na tela do terminal/console.
 *
 * @author Everton
 */
class ConsoleLogger implements \Psr\Log\LoggerInterface {
    
    /**
     * Uma ação deve ser tomada imediatamente.
     * 
     * Exibida quando uma situação ocorre e o usuário deve tomar alguma providência.
     * 
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function alert($message, array $context = []): void {
        $this->log('ALERT', $message, $context);
    }

    /**
     * Uma condição crítica ocorreu.
     * 
     * Tipicamente um exception que termina a execução.
     * 
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function critical($message, array $context = []): void {
        $this->log('CRITICAL', $message, $context);
    }

    /**
     * Informação detalhada para debug.
     * 
     * Somente é exibida na tela se DEBUG_MODE = true.
     * 
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function debug($message, array $context = []): void {
        if(DEBUG_MODE == true){
            $this->log('DEBUG', $message, $context);
        }
    }

    /**
     * O sistema está fora de uso.
     * 
     * Um exception não tratado ou erro fatal.
     * 
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function emergency($message, array $context = []): void {
        $this->log('EMERGENCY', $message, $context);
    }

    /**
     * Erro em tempo de execução que não requer ação imediata mas é tipicamente monitorado.
     * 
     * Tipicamente um exception que é tratado para a continuação da execução ou um erro não fatal.
     * 
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function error($message, array $context = []): void {
        $this->log('ERROR', $message, $context);
    }

    /**
     * Evento de interesse.
     * 
     * Tipicamente marca o início/fim de cada subrotina.
     * 
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function info($message, array $context = []): void {
        $this->log('INFO', $message, $context);
    }

    /**
     * Envia a mensagem de log para a tela.
     * 
     * @param string $level Usar preferencialmente as constantes Psr\Log\LogLevel.
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function log($level, $message, array $context = []): void {
        $level = strtoupper($level);
        echo "[$level]\t\t", $message , PHP_EOL;
    }

    /**
     * Evento normal, porém significante.
     * 
     * Tipicamente os marcos importantes dentro de cada subrotina.
     * 
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function notice($message, array $context = []): void {
        $this->log('NOTICE', $message, $context);
    }

    /**
     * Ocorrência excepcional mas que não é um erro.
     * 
     * Tipicamente algum evento fora do normal mas que não prejudica o resultado final.
     * 
     * @param string $message
     * @param mixed $context
     * @return void
     */
    public function warning($message, array $context = []): void {
        $this->log('WARNING', $message, $context);
    }
}
