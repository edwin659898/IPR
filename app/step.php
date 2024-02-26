<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class step extends Model
{
  protected $fillable = ['step','description','uom','quantityR','unitP','totalP','todo_id','budget','supplier','decision',];
}
