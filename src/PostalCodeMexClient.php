<?php

namespace OmSoft\PostalCodeMexClient;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use RuntimeException;

class PostalCodeMexClient
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('postalcodemexclient.base_url', env('POSTALCODEMEX_BASE_URL', 'https://postalcodemex.omsoft.com.mx/api/v1'));
        $this->apiKey = config('postalcodemexclient.api_key', env('POSTALCODEMEX_API_KEY', ''));
    }

    protected function makeRequest(): PendingRequest
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept' => 'application/json',
        ])->baseUrl($this->baseUrl);
    }

    /**
     * Process response and handle errors
     *
     * @param Response $response
     * @return array
     * @throws RuntimeException
     */
    protected function processResponse(Response $response): array
    {
        if ($response->failed()) {
            Log::error('PostalCodeMex API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new RuntimeException(
                "API request failed with status: {$response->status()}, message: {$response->body()}"
            );
        }

        return $response->json();
    }

    /**
     * Get neighborhoods by postal code
     *
     * @param string $cp Postal code
     * @return array
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public function getNeighborhoods(string $cp): array
    {
        if (empty($cp)) {
            throw new InvalidArgumentException("Postal code cannot be empty");
        }

        try {
            $response = $this->makeRequest()->get("/codigo_postal/{$cp}/colonias");
            return $this->processResponse($response);
        } catch (ConnectionException $e) {
            Log::error('PostalCodeMex connection error', ['message' => $e->getMessage()]);
            throw new RuntimeException("Connection error: {$e->getMessage()}", 0, $e);
        }
    }

    /**
     * Get all states
     *
     * @return array
     * @throws RuntimeException
     */
    public function getStates(): array
    {
        try {
            $response = $this->makeRequest()->get("/estados");
            return $this->processResponse($response);
        } catch (ConnectionException $e) {
            Log::error('PostalCodeMex connection error', ['message' => $e->getMessage()]);
            throw new RuntimeException("Connection error: {$e->getMessage()}", 0, $e);
        }
    }

    /**
     * Get towns by state
     *
     * @param string $state State code
     * @return array
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public function getTownByState(string $state): array
    {
        if (empty($state)) {
            throw new InvalidArgumentException("State code cannot be empty");
        }

        try {
            $response = $this->makeRequest()->get("/estados/{$state}/municipios");
            return $this->processResponse($response);
        } catch (ConnectionException $e) {
            Log::error('PostalCodeMex connection error', ['message' => $e->getMessage()]);
            throw new RuntimeException("Connection error: {$e->getMessage()}", 0, $e);
        }
    }

    /**
     * Get postal codes by town
     *
     * @param string $town Town code
     * @return array
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public function getPostalCodesByTown(string $town): array
    {
        if (empty($town)) {
            throw new InvalidArgumentException("Town code cannot be empty");
        }

        try {
            $response = $this->makeRequest()->get("/municipios/{$town}/codigos_postales");
            return $this->processResponse($response);
        } catch (ConnectionException $e) {
            Log::error('PostalCodeMex connection error', ['message' => $e->getMessage()]);
            throw new RuntimeException("Connection error: {$e->getMessage()}", 0, $e);
        }
    }

    /**
     * Get settlement types
     *
     * @return array
     * @throws RuntimeException
     */
    public function getSettlements(): array
    {
        try {
            $response = $this->makeRequest()->get("/tipos_asentamientos");
            return $this->processResponse($response);
        } catch (ConnectionException $e) {
            Log::error('PostalCodeMex connection error', ['message' => $e->getMessage()]);
            throw new RuntimeException("Connection error: {$e->getMessage()}", 0, $e);
        }
    }

    /**
     * Get zone types
     *
     * @return array
     * @throws RuntimeException
     */
    public function getZones(): array
    {
        try {
            $response = $this->makeRequest()->get("/tipos_zonas");
            return $this->processResponse($response);
        } catch (ConnectionException $e) {
            Log::error('PostalCodeMex connection error', ['message' => $e->getMessage()]);
            throw new RuntimeException("Connection error: {$e->getMessage()}", 0, $e);
        }
    }
}
