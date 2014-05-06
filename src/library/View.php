<?php
namespace library;

/**
 * Utility class 'View', intended to
 * render content of a file to browser.
 */
class View
{
    /**
     * Render the content of given file 
     * with passed specific user data.
     * 
     * @param  string $file, name of the view file
     * @param  array  $data, data to be rendered
     * @return mixed
     */
    public static function render($file, Array $data=array())
    {
        if ( ! empty($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        ob_start();
        include PATH_VIEWS . "/{$file}.php";
        $buffer = ob_get_contents();
        @ob_end_clean();
        return $buffer;
    }
}