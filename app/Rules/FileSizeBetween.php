<?php

// FileSizeBetween.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileSizeBetween implements Rule
{
    protected $minSize;
    protected $maxSize;

    public function __construct($minSize, $maxSize)
    {
        $this->minSize = $minSize * 1024; // Convert KB to bytes
        $this->maxSize = $maxSize * 1024; // Convert KB to bytes
    }

    public function passes($attribute, $value)
    {
        $fileSize = filesize($value); // Get file size in bytes
        return $fileSize >= $this->minSize && $fileSize <= $this->maxSize;
    }

    public function message()
    {
        return "The file size must be between " . ($this->minSize / 1024) . "KB and " . ($this->maxSize / 1024) . "KB.";
    }
    
}
