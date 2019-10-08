<?php

namespace App\Excels;

use App\Models\Product;
use App\Models\CourseWithLesson;
use App\Models\CatalogV;
use App\Models\Video;

use Maatwebsite\Excel\Concerns\FromCollection;

class CourseExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $result = collect();
        $products = Product::get();

        for ( $i=0; $i < sizeof( $products ); $i++ ) {             

            $current_product = $products[$i];    
            $catalog_vs = CatalogV::where( 'product_id', $current_product->id )->get();
            
            for ( $j=0; $j < sizeof( $catalog_vs ); $j++ ) { 
                
                $current_course = $catalog_vs[$j];
                $lessons =  Video::where('catalog_v_id', $current_course->id)->get();
                for ($k=0; $k < sizeof( $lessons ); $k++) {

                    $current_lesson = $lessons[$k];

                    $summary_data = new CourseWithLesson();
                    $summary_data->category_name = trim( $current_product->name );
                    $summary_data->course_id = $current_course->id;
                    $summary_data->course_name = $current_course->name;
                    $summary_data->lesson_name = $current_lesson->name;

                    $parts_of_link = explode("/", $current_lesson->link);
                    $summary_data->video_link = trim( end( $parts_of_link ) );

                    $result->add($summary_data);

                }                
            }
        }

        return $result;
    }
}
