<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = 'staff';
	protected $primaryKey = 'Id';

	//protected $guarded = [];
	protected $fillable = ['Name', 'Address', 'PhoneNo', 'Email'];

	public function repairs()
	{
		return $this->hasMany('App\Repair', 'StaffId', 'Id');
	}
}
