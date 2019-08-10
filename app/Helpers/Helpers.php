<?php

if(! function_exists('prettyPrint')){

    /**
     * 漂亮的数据打印
     * @param array $data
     * @return string
     */
    function prettyPrint(array $data = [])
    {

        return highlight_string("\n<?php\n" . var_export($data, true) . ";\n?>\n", true);

    }

}
