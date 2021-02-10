<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Json;

class InstituicaoController extends Controller
{
    /**
     * Verify credentials
     *
     *
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $passwordInserted = $request->input('password');
        $instituicao = Instituicao::where('email', $email)->first();

        if (!empty($instituicao)) {
            $password = $instituicao->password;
            if (Hash::check($passwordInserted, $password)) {
                return array_merge($instituicao->toArray(), ['token' => $this->generateToken(), 'result' => 1]);
            }
        }

        return json_encode(["message" => "Invalid Credentials", 'result' => 0]);
    }

    private function generateToken() {
        $size = 15;
        $lowerCase = 'abcdefghijklmnopqrstuvwxyz';
        $upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = 30;
        $sum = 0;
        $token = '';
        for ($i = 0; $i < $size; $i++) {
           if ($i < 5) {
               $randomNumber = $this->getRandomNumber($i, $max, $sum);
               $token .= $randomNumber;
               $sum += intval($randomNumber);
           } elseif ($i < 10) {
               $token .= $lowerCase[rand(0, strlen($lowerCase) - 1)];
           } else {
               $token .= $upperCase[rand(0, strlen($upperCase) - 1)];
           }
        }

        return str_shuffle($token);
    }

    private function getRandomNumber(int $i, int $max, int $sum)
    {
        $numbers = '456789';
        if ($i < 3) {
            $randomNumber = $numbers[rand(0, strlen($numbers) - 1)];

        } else {
            $diff = $max - $sum;
            if ($diff >= 10) {
                $randomNumber = 9;
            } else {
                $randomNumber = $diff;
            }
        }
        return $randomNumber;
    }
}
