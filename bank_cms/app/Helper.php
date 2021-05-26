<?php

namespace App;

use http\Exception;
use Image;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Input as Input;
use App\Models\AdminSettings;
use App\Models\Images;
use App\Models\OrderVideo;
use App\Models\OrderItemsVideo;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

DEFINE('DS', DIRECTORY_SEPARATOR);

class Helper
{


    public static function uuid4()
    {
        $uuid4 = Uuid::uuid4();
        return $uuid4->toString();
    }


    // Text With (2) line break
    public static function checkTextDb($str)
    {
        //$str = trim( self::spaces( $str ) );
        if (mb_strlen($str, 'utf8') < 1) {
            return false;
        }
        $str = preg_replace('/(?:(?:\r\n|\r|\n)\s*){3}/s', "\r\n\r\n", $str);
        $str = trim($str, "\r\n");

        return $str;
    }

    public static function checkText($str)
    {
        //$str = trim( self::spaces( $str ) );
        if (mb_strlen($str, 'utf8') < 1) {
            return false;
        }

        $str = nl2br(e($str));
        $str = str_replace([chr(10), chr(13)], '', $str);

        $str = stripslashes($str);

        return $str;
    }

    public static function formatNumber($number)
    {
        if ($number >= 1000 && $number < 1000000) {
            return number_format($number / 1000, 1) . "k";
        } elseif ($number >= 1000000) {
            return number_format($number / 1000000, 1) . "M";
        } else {
            return $number;
        }
    } //<<<<--- End Function

    public static function formatNumbersStats($number)
    {
        if ($number >= 100000000) {
            return '<span class=".numbers-with-commas counter">' . number_format($number / 1000000, 0) . "</span>M";
        } else {
            return '<span class=".numbers-with-commas counter">' . number_format($number) . '</span>';
        }
    } //<<<<--- End Function

    public static function spaces($string)
    {
        return preg_replace('/(\s+)/u', ' ', $string);
    }

    public static function resizeImage($image, $width, $height, $scale, $imageNew = null, $dpi = false, $quality = 90)
    {
        ini_set('memory_limit', '10000M');

        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                imagefill($newImage, 0, 0, imagecolorallocate($newImage, 255, 255, 255));
                imagealphablending($newImage, true);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);

                //imagefill( $newImage, 0, 0, imagecolorallocate( $newImage, 255, 255, 255 ) );
                //imagealphablending( $newImage, TRUE );
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);
        // kill source

        imagedestroy($source);

        if ($dpi) {
            imageresolution($newImage, $dpi);
        }
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $imageNew);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $imageNew, $dpi ? 100 : $quality);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $imageNew);
                break;
        }

        chmod($image, 0777);
        return $image;
    }

    public static function resize_image_without_scale(
        $image,
        $width,
        $height = 0,
        $imageNew,
        $dpi = false,
        $quality = 90
    ) {
        ini_set('memory_limit', '10000M');

        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $newImageWidth = $width;
        $newImageHeight = $height;
        if (!$width && !$height) {
            Log::error('set at least one of $width , $height');
            die('1');
        }
        if (!$width) {
            $newImageWidth = floor(round($height * $imagewidth / $imageheight, 2));
        }
        if (!$height) {
            $newImageHeight = floor(round($width * $imageheight / $imagewidth, 2));
        }
        $imageType = image_type_to_mime_type($imageType);

        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                imagefill($newImage, 0, 0, imagecolorallocate($newImage, 255, 255, 255));
                imagealphablending($newImage, true);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);

                //imagefill( $newImage, 0, 0, imagecolorallocate( $newImage, 255, 255, 255 ) );
                //imagealphablending( $newImage, TRUE );
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imagewidth, $imageheight);
        // kill source

        imagedestroy($source);

        if ($dpi) {
            imageresolution($newImage, $dpi);
        }
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $imageNew);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $imageNew, $dpi ? 100 : $quality);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $imageNew);
                break;
        }

        chmod($image, 0777);
        return $image;
    }

    public static function resizeImageFixed($image, $width, $height, $imageNew = null)
    {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImage = imagecreatetruecolor($width, $height);

        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                imagefill($newImage, 0, 0, imagecolorallocate($newImage, 255, 255, 255));
                imagealphablending($newImage, true);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);

                /*imagefill( $newImage, 0, 0, imagecolorallocate( $newImage, 255, 255, 255 ) );
                 imagealphablending( $newImage, TRUE );*/
                break;
        }
        if ($width / $imagewidth > $height / $imageheight) {
            $nw = $width;
            $nh = ($imageheight * $nw) / $imagewidth;
            $px = 0;
            $py = ($height - $nh) / 2;
        } else {
            $nh = $height;
            $nw = ($imagewidth * $nh) / $imageheight;
            $py = 0;
            $px = ($width - $nw) / 2;
        }

        imagecopyresampled($newImage, $source, $px, $py, 0, 0, $nw, $nh, $imagewidth, $imageheight);

        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $imageNew);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $imageNew, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $imageNew);
                break;
        }

        chmod($image, 0777);
        return $image;
    }

    public static function getHeight($image)
    {
        $size = getimagesize($image);
        $height = intval($size[1]);
        return $height;
    }

    public static function getWidth($image)
    {
        $size = getimagesize($image);
        $width = intval($size[0]);
        return $width;
    }

    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = ['', 'kB', 'MB', 'GB', 'TB'];

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }

    public static function removeHTPP($string)
    {
        $string = preg_replace('#^https?://#', '', $string);
        return $string;
    }

    public static function Array2Str($kvsep, $entrysep, $a)
    {
        $str = "";
        foreach ($a as $k => $v) {
            $str .= "{$k}{$kvsep}{$v}{$entrysep}";
        }
        return $str;
    }

    public static function removeBR($string)
    {
        $html = preg_replace('[^(<br( \/)?>)*|(<br( \/)?>)*$]', '', $string);
        $output = preg_replace('~(?:<br\b[^>]*>|\R){3,}~i', '<br /><br />', $html);
        return $output;
    }

    public static function removeTagScript($html)
    {
        //parsing begins here:
        $doc = new \DOMDocument();
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $nodes = $doc->getElementsByTagName('script');

        $remove = [];

        foreach ($nodes as $item) {
            $remove[] = $item;
        }

        foreach ($remove as $item) {
            $item->parentNode->removeChild($item);
        }

        return preg_replace('/^<!DOCTYPE.+?>/', '',
            str_replace(['<html>', '</html>', '<body>', '</body>', '<head>', '</head>', '<p>', '</p>', '&nbsp;'],
                ['', '', '', '', '', ' '], $doc->saveHtml()));
    } // End Method

    public static function removeTagIframe($html)
    {
        //parsing begins here:
        $doc = new \DOMDocument();
        @$doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $nodes = $doc->getElementsByTagName('iframe');

        $remove = [];

        foreach ($nodes as $item) {
            $remove[] = $item;
        }

        foreach ($remove as $item) {
            $item->parentNode->removeChild($item);
        }

        return preg_replace('/^<!DOCTYPE.+?>/', '',
            str_replace(['<html>', '</html>', '<body>', '</body>', '<head>', '</head>', '<p>', '</p>', '&nbsp;'],
                ['', '', '', '', '', ' '], $doc->saveHtml()));
    } // End Method

    public static function fileNameOriginal($string)
    {
        return pathinfo($string, PATHINFO_FILENAME);
    }

    public static function formatDate($date)
    {
        $day = date('d', strtotime($date));
        //		$_month = date('m', strtotime($date));
        $month = date('m', strtotime($date)); //trans("months.$_month");
        $year = date('Y', strtotime($date));

        $dateFormat = $day . ' / ' . $month . ' / ' . $year;

        return $dateFormat;
    }

    public static function watermark($name, $watermarkSource)
    {
        $thumbnail = Image::make($name);
        $watermark = Image::make($watermarkSource);
        if ($thumbnail->height() > $thumbnail->width()) {
            $watermark_width = $thumbnail->width();
            $watermark_height = round(($watermark_width * $watermark->height()) / $watermark->width(), 2);
        } else {
            $watermark_height = $thumbnail->height();
            $watermark_width = round(($watermark_height * $watermark->width()) / $watermark->height(), 2);
        }
        $watermark->resize($watermark_width, $watermark_height);
        $thumbnail->insert($watermark, 'center');
        $thumbnail->save($name)->destroy();
        $watermark->destroy();
    }

    public static function init_elasticsearch()
    {
        $logger = new \Monolog\Logger('elasticsearch');
        $log_level = config('app.debug') == true ? \Monolog\Logger::DEBUG : \Monolog\Logger::WARNING;
        $logger->pushHandler(new \Monolog\Handler\StreamHandler(base_path('storage/logs/elasticsearch.log'),
            $log_level));
        $client = \Elasticsearch\ClientBuilder::create()
            ->setLogger($logger)
            ->build();
        return $client;
    }

    public static function search_in_elasticsearch($type, $query, $filters = [])
    {
        // prepare filters
        if (!isset($filters['not_in_ids'])) {
            $filters['not_in_ids'] = [];
        } else {
            $temp_array1 = array_map(function ($item) {
                return $item . "ar";
            }, $filters['not_in_ids']);
            $temp_array2 = array_map(function ($item) {
                return $item . "en";
            }, $filters['not_in_ids']);
            $filters['not_in_ids'] = array_merge($temp_array1, $temp_array2);
        }

        if ($type === 'images') {
            $elasticsearch_index = $type;
            $elasticsearch_filter = 'image';
            $class_name = '\App\Models\Images';
        } elseif ($type === 'videos') {
            $elasticsearch_index = $type;
            $elasticsearch_filter = 'video';
            $class_name = '\App\Models\Videos';
        } else {
            $elasticsearch_index = 'images';
            $elasticsearch_filter = 'image';
            $class_name = '\App\Models\Images';
        }

        $client = Helper::init_elasticsearch();

        // paginations
        $page = Input::get('page', 1);
        $settings = AdminSettings::first();
        $from = ($page - 1) * $settings->result_request;
        $size = $settings->result_request;

        // search
        $params = [
            'index' => $elasticsearch_index,
            'body'  => [
                'from'    => $from,
                'size'    => $size,
                '_source' => 'search_result_data.*',
                'query'   => [
                    "bool" => [
                        "must"     => [
                            'multi_match' => [
                                'fields' => ['search_data.full_text_boosted^7', 'search_data.full_text^2'],
                                'type'   => 'cross_fields',
                                'query'  => $query,
                            ],
                        ],
                        "filter"   => [
                            "match" => [
                                "type" => $elasticsearch_filter,
                            ],
                        ],
                        "must_not" => [
                            "ids" => [
                                "values" => $filters['not_in_ids'],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $results = $client->search($params);
        $items = collect($results['hits']['hits'])
            ->pluck('_source.search_result_data')
            ->map(function ($item) {
                return $item['id'];
            })
            ->toArray();


        $items = $class_name::whereIn('id', $items)->get();
        $items = collect(array_fill(0, $from, 1))
            ->toBase()
            ->merge($items);
        $total = $results['hits']['total']['value'];

        // we use the sortBy method from collection class
        $paginated = \App\CollectionHelper::paginate($items, $total, $size);

        return $paginated;
    }

    public static function check_spelling_in_elasticsearch($type, $query)
    {
        if ($type === 'images') {
            $elasticsearch_index = $type;
            $elasticsearch_filter = 'image';
        } elseif ($type === 'videos') {
            $elasticsearch_index = $type;
            $elasticsearch_filter = 'video';
        }

        $client = Helper::init_elasticsearch();

        // paginations
        $page = Input::get('page', 1);
        $settings = AdminSettings::first();
        $from = ($page - 1) * $settings->result_request;
        $size = $settings->result_request;

        // spell suggest
        $params = [
            'index' => $elasticsearch_index,
            'body'  => [
                'suggest' => [
                    'spelling-suggest' => [
                        'text' => $query,
                        'term' => [
                            'field'         => 'suggestion_terms',
                            'prefix_length' => 0,
                            /* 'analyzer' => 'LanguageAnalyzers.Arabic', */
                        ],
                    ],
                ],
            ],
        ];

        $results = $client->search($params);
        $term_alternative = "";
        $items = collect($results['suggest']['spelling-suggest'])
            ->keyBy('text')
            ->filter(function ($item) {
                return count($item['options']) > 0;
            })
            ->map(function ($item) use ($query, $term_alternative) {
                return $item['options'][0]['text'];
            })
            ->toArray();

        $term_alternative = str_replace(array_keys($items), array_values($items), $query);

        return $term_alternative;
    }

    public static function autocomplete_in_elasticsearch($type, $query)
    {
        if ($type === 'images') {
            $elasticsearch_index = $type;
            $elasticsearch_filter = 'image';
        } elseif ($type === 'videos') {
            $elasticsearch_index = $type;
            $elasticsearch_filter = 'video';
        }

        $client = Helper::init_elasticsearch();

        // paginations
        $page = Input::get('page', 1);
        $settings = AdminSettings::first();
        $from = ($page - 1) * $settings->result_request;
        $size = $settings->result_request;

        // auto complete
        $params = [
            'index' => $elasticsearch_index,
            'body'  => [
                '_source' => 'no_source',
                'suggest' => [
                    'auto-complete-suggest' => [
                        'prefix'     => $query,
                        'completion' => [
                            'field'           => 'completion_terms',
                            'fuzzy'           => [
                                'fuzziness' => 3,
                            ],
                            'size'            => 10,
                            'skip_duplicates' => true,
                        ],
                    ],
                ],
            ],
        ];
        $results = $client->search($params);

        $items = collect($results['suggest']['auto-complete-suggest'][0]['options'])
            ->pluck('text')
            ->toArray();

        // if no autocomplete, try for spell checking
        if (count($items) === 0) {
            $term_alternative = \App\Helper::check_spelling_in_elasticsearch($type, $query);
            if ($term_alternative !== $query) {
                $items[] = $term_alternative;
            }
        }

        return $items;
    }

    //resize and crop image by center by ahed
    public static function resize_crop_image($source_file, $width, $height, $dst_dir)
    {
        $imgsize = getimagesize($source_file);
        $w = $imgsize[0];
        $h = $imgsize[1];
        $mime = $imgsize['mime'];

        switch ($mime) {
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image_out = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image_out = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image_out = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }
        $image = $image_create($source_file);
        $w = @imagesx($image); //current width
        $h = @imagesy($image); //current height
        if (!$w || !$h) {
            $GLOBALS['errors'][] = 'Image could not be resized because it was not a valid image.';
            return false;
        }
        if ($w == $width && $h == $height) {
            return $image;
        } //no resizing needed

        //try max width first...
        $ratio = $width / $w;
        $new_w = $width;
        $new_h = $h * $ratio;

        //if that created an image smaller than what we wanted, try the other way
        if ($new_h < $height) {
            $ratio = $height / $h;
            $new_h = $height;
            $new_w = $w * $ratio;
        }

        $image2 = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($image2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

        //check to see if cropping needs to happen
        if ($new_h != $height || $new_w != $width) {
            $image3 = imagecreatetruecolor($width, $height);
            if ($new_h > $height) {
                //crop vertically
                $extra = $new_h - $height;
                $x = 0; //source x
                $y = round($extra / 2); //source y
                imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
            } else {
                $extra = $new_w - $width;
                $x = round($extra / 2); //source x
                $y = 0; //source y
                imagecopyresampled($image3, $image2, 0, 0, $x, $y, $width, $height, $width, $height);
            }
            imagedestroy($image2);
            $image_out($image3, $dst_dir, 100);
            return true;
        } else {
            $image_out($image2, $dst_dir, 100);
            return true;
        }
    }
} //<--- End Class

class CollectionHelper
{
    public static function paginate(Collection $results, $total, $pageSize)
    {
        $page = Paginator::resolveCurrentPage('page');

        return self::paginator($results->forPage($page, $pageSize), $total, $pageSize, $page, [
            'path'     => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    /**
     * Create a new length-aware paginator instance.
     *
     * @param \Illuminate\Support\Collection $items
     * @param int                            $total
     * @param int                            $perPage
     * @param int                            $currentPage
     * @param array                          $options
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class,
            compact('items', 'total', 'perPage', 'currentPage', 'options'));
    }
}

function cdn_path($path = '')
{
    if ($path && mb_substr($path, 0, 1) !== "/") {
        $path = "/" . $path;
    }
    return 'https://arabsstock.fra1.digitaloceanspaces.com' . $path;
}


