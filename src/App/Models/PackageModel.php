<?php
namespace Jeybin\Packagename\App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Base
 * @package App\Models
 */
class PackageModel extends Model{

    protected $table    = 'packagename';

    /**
     * Disable mass insert/update 
     * from the project
     */
    protected $fillable = [];
    

}
