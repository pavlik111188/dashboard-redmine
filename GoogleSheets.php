<?php

class GoogleSheets
{
    protected $appName;
    protected $credentialsPath;
    protected $clientSecretPath;
    protected $scopes;
    protected $googleClient;
    protected $service;

    public function __construct($appName, $credentialsPath, $clientSecretPath)
    {
        $this->scopes = implode(' ', [Google_Service_Sheets::SPREADSHEETS]);
        $this->appName = $appName;
        $this->credentialsPath = $credentialsPath;
        $this->clientSecretPath = $clientSecretPath;
    }

    /**
     * Returns an authorized API client.
     * @return mixed
     */
    protected function getClient()
    {
        $accessToken = $this->getAccessToken();

        if ($accessToken === false) {
            return false;
        } else {
            $client = $this->getGoogleClient();
            $client->setAccessToken($accessToken);
            if ($client->isAccessTokenExpired()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($this->credentialsPath, json_encode($client->getAccessToken()));
            }
            return $client;
        }
    }

    protected function getService()
    {
        if ($this->service == null)
            $this->service = new Google_Service_Sheets($this->getClient());
        return $this->service;
    }

    public function isReady()
    {
        return $this->getClient() !== false;
    }

    protected function getAccessToken()
    {
        if (file_exists($this->credentialsPath)) {
            return json_decode(file_get_contents($this->credentialsPath), true);
        } else {
            return false;
        }
    }

    public function saveAccessToken($authCode)
    {
        $client = $this->getGoogleClient();
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $result = file_put_contents($this->credentialsPath, json_encode($accessToken));
        if ($result !== false)
            return true;
        else
            return false;
    }

    public function getAuthUrl()
    {
        $client = $this->getGoogleClient();
        return $client->createAuthUrl();
    }

    protected function getGoogleClient()
    {
        if ($this->googleClient == null) {
            $client = new Google_Client();
            $client->setApplicationName($this->appName);
            $client->setScopes($this->scopes);
            $client->setAuthConfig($this->clientSecretPath);
            $client->setAccessType('offline');
            $this->googleClient = $client;
        }
        return $this->googleClient;
    }

    public function writeRow($listId, $range, $values)
    {
        $body = new Google_Service_Sheets_ValueRange([
            'values' => [$values]
        ]);
        $params = ['valueInputOption' => 'RAW'];
        try {
            $this->getService()->spreadsheets_values->update($listId, $range, $body, $params);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function append($listId, $range, $values)
    {
        $body = new Google_Service_Sheets_ValueRange([
            'values' => [$values]
        ]);
        $params = ['valueInputOption' => 'RAW'];
        try {
            $this->getService()->spreadsheets_values->append($listId, $range, $body, $params);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getRows($listId, $range)
    {
        $response = $this->getService()->spreadsheets_values->get($listId, $range);
        return $response->getValues();
    }

    public function getSheets($listId)
    {
        $response = $this->getService()->spreadsheets->get($listId)->getSheets();
        return $response;
    }
}