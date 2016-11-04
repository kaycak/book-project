<?php 
namespace App\Services;
use App\Models\Section;

class SectionService
{
	public function __construct(Section $section){
		$this->section = $section;
	}
}

?>