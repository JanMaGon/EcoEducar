<?php

namespace App\Models;

use CodeIgniter\Model;

class PostGalleryModel extends Model
{
    protected $table = 'post_gallery';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    
    protected $allowedFields = [
        'post_id',
        'image_name'
    ];
}
