<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Response\CurlResponse;

class FileUploader
{
    public const PASSPORT_DIR = '/passport/';
    public const CV_DIR = '/cv/';
    public const PROFILE_PICTURE_DIR = '/profile_picture/';
    private string $freeimgUrl = "https://freeimage.host/api/1/upload";

    public function __construct(
        private string $targetDirectory,
        private SluggerInterface $slugger,
        private string $freeimgApiKey,
        private HttpClientInterface $client

    ) {}

    public function upload(UploadedFile $file, string $subDir): string
    {
        $apiUrl = $this->getApiUrl();
        $b64File = base64_encode($file->getContent());

        try {
            $response = $this->client->request('POST', $apiUrl, [
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'body' => [
                    'key' => $this->freeimgApiKey,
                    'action' => 'upload',
                    'source' => $b64File,
                    'format' => 'json'
                ]
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                throw new Exception("Failed to upload file. HTTP status code: $statusCode");
            }

            $responseData = $response->toArray();

            if (isset($responseData['image']['url'])) {
                return $responseData['image']['url'];
            }

            throw new Exception("Unexpected API response format.");
        } catch (ClientException $e) {
        }
    }


    private function getApiUrl(): string
    {
        return $this->freeimgUrl;
    }
}
