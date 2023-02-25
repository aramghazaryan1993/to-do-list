<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Class Tag
     * @package App\Models
     */

    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var array
     */
    protected $hidden = ['pivot'];
}
