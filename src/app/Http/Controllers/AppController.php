<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;

class AppController extends Controller
{
    function getList() {
        $codes = Code::all();
        return $codes;
    }

    function generate() {
        $words = request('words'); //入力を取得
        $codes = '';
        if ($words) { //入力があるか確認
            $words = str_split($words); //文字列を配列に分割
            for ($i = 0; $i < count($words); $i++) {
                $word = $words[$i];
                if (preg_match('/[A-Z]|[0-9]/', $word)) { //入力可能な文字か確認
                    $code = Code::where('word', $word)->select('code')->get();
                    $codes .= $code[0]['code'];
                }
                if ($i !== count($words)-1) $codes .= '　'; //空白を追加
            }
        }
        return $codes;
    }
}
