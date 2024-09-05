<?php

namespace OmSoft\PostalCodeMexClient;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PostalCodeMexClient
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('postalcodemexclient.base_url');
        $this->apiKey = config('postalcodemexclient.api_key');
    }

    protected function makeRequest(): PendingRequest
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept' => 'application/json',
        ])->baseUrl($this->baseUrl);
    }

    /**
     * @throws ConnectionException
     */
    public function getNeighborhoods(string $cp): PromiseInterface|Response
    {
        return $this->makeRequest()->get( "/codigo_postal/{$cp}/colonias");
    }

    /**
     * @throws ConnectionException
     */
    public function getStates(): PromiseInterface|Response
    {
        return $this->makeRequest()->get( "/estados");
    }

    /**
     * @throws ConnectionException
     */
    public function getTownByState(string $state): PromiseInterface|Response
    {
        return $this->makeRequest()->get( "/estados/{$state}/municipios");
    }

    /**
     * @throws ConnectionException
     */
    public function getPostalCodesByTown(string $town): PromiseInterface|Response
    {
        return $this->makeRequest()->get( "/municipios/{$town}/codigos_postales");
    }

    /**
     * @throws ConnectionException
     */
    public function getSettlements(): PromiseInterface|Response
    {
        return $this->makeRequest()->get( "/tipos_asentamientos");
    }

    /**
     * @throws ConnectionException
     */
    public function getZones(): PromiseInterface|Response
    {
        return $this->makeRequest()->get( "/tipos_zonas");
    }
}
