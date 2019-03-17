<?php
/**
 * File LaravueController.php
 *
 * @author Tuan Duong <tuan@metroworks.co.jp>
 * @package ACQ
 * @version 3.0
 */

namespace Tuandm\Laravue\Http\Controllers;

use Illuminate\Http\Request;

class LaravueController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        return view('laravue::index');
    }
}
