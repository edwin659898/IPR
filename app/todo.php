<?php

namespace App;

use App\step;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class todo extends Model
{
  protected $fillable = [
    'vat', 'currency', 'date_initiated', 'initiator', 'initiator_site',
    'department', 'leadT',
    'explanation', 'status',
    'slmD', 'slmN', 'slmC',
    'hodD', 'hodN', 'hodC',
    'opD', 'opN', 'opC',
    'mdD', 'mdN', 'mdC', 'type', 'printed', 'email', 'slmM', 'hodM', 'opM', 'reviewer',
  ];


  public function step()
  {
    return $this->hasMany(step::class);
  }

  public function image()
  {
    return $this->hasMany(image::class);
  }

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id')->withDefault();
  }
}
