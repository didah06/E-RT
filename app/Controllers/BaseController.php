<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['global', 'form', 'filesystem'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
    protected function _validation($field, $label, $rules)
    {
        $validate   = explode('|', $rules);
        $errors     = [];

        foreach ($validate as $rule) {
            $exp    = explode('[', $rule);
            $key    = $exp[0];
            $param  = str_between($rule, '[', ']');

            if ($key == 'required') {
                $errors[$key]  = $label . ' harus diisi';
            } else if ($key == 'is_unique') {
                $errors[$key]  = $label . ' sudah tersedia';
            } else if ($key == 'min_length') {
                $errors[$key]  = $label . ' paling sedikit ' . $param . ' karakter';
            } else if ($key == 'max_length') {
                $errors[$key]  = $label . ' paling banyak ' . $param . ' karakter';
            } else if ($key == 'is_natural') {
                $errors[$key]  = $label . ' harus angka';
            } else if ($key == 'valid_date') {
                $errors[$key]  = $label . ' harus berisi tanggal valid (' . $param . ')';
            } else if ($key == 'valid_time') {
                $errors[$key] = $label . 'harus berisi waktu valid (' . $param . ')';
            } else if ($key == 'uploaded') {
                $errors[$key]  = $label . ' belum dipilih';
            } else if ($key == 'max_size') {
                $max    = str_replace($field . ',', '', $param);
                $errors[$key]  = $label . ' terlalu besar (max: ' . $max . 'KB )';
            } else if ($key == 'max_dims') {
                $max    = str_replace($field . ',', '', $param);
                $max    = str_replace(',', 'x', $max);
                $errors[$key]  = $label . ' dimensi terlalu besar (max: ' . $max . ')';
            } else if ($key == 'mime_in') {
                $param  = str_replace($field . ',', '', $param);
                $errors[$key]  = $label . ' type tidak diizinkan (type: ' . $param . ')';
            } else if ($key == 'ext_in') {
                $param  = str_replace($field . ',', '', $param);
                $errors[$key]  = $label . ' extension tidak diizinkan (type: ' . $param . ')';
            } else if ($key == 'is_image') {
                $errors[$key]  = $label . ' bukan file gambar';
            } else if ($key == 'decimal') {
                $errors[$key]  = $label . 'harus berisi decimal valid';
            } else if ($key == 'is_natural_no_zero') {
                $errors[$key]  = $label . 'harus lebih dari 0';
            }
        }
        if (!$this->validate(
            [
                $field  => [
                    'rules'     => $rules,
                    'errors'    => $errors,
                ],
            ],
        )) {
            $validation     = \Config\Services::validation();
            return $validation->getError($field);
        } else {
            return '';
        }
    }
}
