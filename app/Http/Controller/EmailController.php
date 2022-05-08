<?php

namespace Unicall\Http\Controller;

use League\Csv\CannotInsertRecord;
use League\Csv\Exception;
use Unicall\Email;
use Unicall\Helper\Request;
use Unicall\Helper\Validator;

class EmailController
{
    public Email $email;
    public Request $request;
    public array $response;

    public function __construct() {
        $this->email = new Email();
        $this->request = new Request();
        $this->response = [];
    }

    public function index() {
        $this->includeView();
    }

    /**
     * @throws CannotInsertRecord
     * @throws Exception
     */
    public function post(): array
    {
        $this->initResponse();

        $email = $this->request->getEmailFromJson();

        if ($email) {
            $this->handle($email);
            $this->apiResponse($email);
            return $this->response;;
        }

        $this->includeView();

        return $this->response;
    }

    public function includeView() {
        return require_once(VIEW_ROOT . 'main.php');
    }

    public function initResponse(): array
    {
        $this->response['email'] = '';
        $this->response['error'] = '';
        $this->response['confirmation'] = false;

        return $this->response;
    }

    public function apiResponse(string $email)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: POST, GET ');
        header('Content-Type: application/json; charset=UTF-8');

        http_response_code(200);
        echo json_encode([
            'response' => $this->response
        ]);
    }

    /**
     * @throws CannotInsertRecord
     * @throws Exception
     */
    public function handle(string $email): array
    {
//          Check if it is valid email
        if (!Validator::isValidEmail($email)) {
            $this->response['error'] = 'Invalid email address';
        } else {
            // If it is valid email, lets check if it is already written in csv file
            $file = $_SERVER['DOCUMENT_ROOT'] . '/data.csv';
            if (!Validator::isUniqueEmail($email, $file)) {
                $this->response['error'] = 'This email address was already added';
            } else {
                $x = $this->insertRecord($email);
                $xx = 123;
            }
        }

        return $this->response;
    }

    /**
     */
    public function insertRecord(string $email): array
    {
        $result = (new Email())->add($email);
        if (empty($result)) {
            $this->response['confirmation'] = true;
            $this->response['email'] = $email;
        }

        $this->response['error'] = $result;
        return $this->response;
    }

}