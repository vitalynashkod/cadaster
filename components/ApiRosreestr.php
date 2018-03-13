<?php

namespace app\components;

use yii\base\BaseObject;

/**
 * Class ApiRosreestr
 * @package app\components
 */
class ApiRosreestr extends BaseObject
{
    public $token = '';

    private $connection;

    const URL = 'http://apirosreestr.ru/api/';

    function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->connection = curl_init();
        curl_setopt_array($this->connection, [
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => ['Token: '. $this->token],
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_VERBOSE => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
        ]);
    }

    private function connect($class, Array $params)
    {
        curl_setopt($this->connection, CURLOPT_URL, self::URL.$class);
        curl_setopt($this->connection, CURLOPT_POSTFIELDS, http_build_query($params));
        $result = curl_exec($this->connection);
        return $result;
    }

    public function getCadasterSearch($query)
    {
        $result = json_decode($this->connect('cadaster/search', ['query' => $query]));
        return $result;
    }

    public function getCadasterObjectInfoFull($query)
    {
        return json_decode($this->connect('cadaster/objectInfoFull', ['query' => $query]));
    }

    public function getCadasterReestr($query) {
        return $this->connect('cadaster/reestr', ['query' => $query]);
    }

    public function getCadasterSaveOrder($query, Array $documents)
    {
        $objectInfoFull = $this->getCadasterObjectInfoFull($query);
        $encoded_object = $objectInfoFull->encoded_object;
        return json_decode($this->connect('cadaster/save_order', [
            'encoded_object' => $encoded_object,
            'documents' => $documents
        ]));
    }

    public function getTransactionInfo($query, Array $documents)
    {
        $cadasterSaveOrder = $this->getCadasterSaveOrder($query, $documents);
        $transactionId = $cadasterSaveOrder->transaction_id;
        return json_decode($this->connect('transaction/info', ['id' => $transactionId]));
    }

    public function getTransactionPay($query, Array $documents)
    {
        $transactionInfo = $this->getTransactionInfo($query, $documents);
        $transactId = $transactionInfo->id;
        $transactConfirm = $transactionInfo->pay_methods->PA->confirm_code;
        return $this->connect('transaction/pay', [
            'id' => $transactId,
            'confirm' => $transactConfirm
        ]);
    }

    public function getCadasterOrders($query, Array $documents)
    {
        $transactionInfo = $this->getTransactionInfo($query, $documents);
        $transactId = $transactionInfo->id;
        return json_decode($this->connect('cadaster/orders ', [
            'id' => $transactId,
        ]));
    }

    public function getCadasterDownload($query, Array $documents)
    {
        $cadasterOrders = $this->getCadasterOrders($query, $documents);
        $documentId = $cadasterOrders->documents[0]->id;
        return json_decode($this->connect('cadaster/download  ', [
            'document_id' => $documentId,
            'format' => 'ZIP'
        ]));
    }
}