<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class CategoryDAO
{
  static function selectAll()
  {
    $cates = DB::table('Category')->get();
    return $cates;
  }
  static function insert($cate)
  {
    $affected = DB::table('Category')->insert(['Name' => $cate->Name]);
    if ($affected > 0) return true;
    return false;
  }
  static function update($cate)
  {
    $affected = DB::table('Category')->where('ID', $cate->ID)->update(['Name' => $cate->Name]);
    if ($affected > 0) return true;
    return false;
  }
  static function delete($id)
  {
    $affected = DB::table('Category')->where('ID', $id)->delete();
    if ($affected > 0) return true;
    return false;
  }
}
