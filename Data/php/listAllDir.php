<?php
file_put_contents('php://stdout', "---------------- POST List Processing Start ----------------\n");

    $routerPath ='';
    if (isset($_GET)) {
        $routerPath = $_GET['path'];
    }

// # function 0
#$folder          = "/wwwroot/127.0.0.1/next/$routerPath"; in BT
    $folder          = "/var/www/html/next/$routerPath";
    $return_array = array();


    // { kind: 'MdxPage', name: 'get-started', route: '/posts/get-started' } as PageMapItem,
    // {
    //   kind: 'Folder', name: 'Markdown', route: '/posts/index', children: [
    //     { kind: 'MdxPage', name: '1', route: '/posts/1' } as PageMapItem,
    //     { kind: 'MdxPage', name: '2', route: '/posts/2' } as PageMapItem,
    //   ]
    // } as PageMapItem

    

    

    function dir_to_array($dir,$rPath,$folder)
    {
            if (! is_dir($dir)) {
                    // If the user supplies a wrong path we inform him.
                    return null;
            }
    
            // Our PHP representation of the filesystem
            // for the supplied directory and its descendant.
            $data = [];
    
            foreach (new DirectoryIterator($dir) as $f) {
                    if ($f->isDot()) {
                            // Dot files like '.' and '..' must be skipped.
                            continue;
                    }
    
                    $path = $f->getPathname();
                    $name = $f->getFilename();


                    $filted_path = str_replace("$folder/","",$path); // Filt Out Root Dir
                    $deepth = substr_count($filted_path,'/'); // Get Folder Deepth
                    $routeDelChar = "/" . $name; // Set Root Delete Char
                    $finalRoute = ($deepth === 0) ? '' :  str_replace($routeDelChar,"",$filted_path) . '/';

                    if ($f->isFile()) {
                        if (str_contains($name, '.mdx')) {
                            $fileT = filemtime($path);
                            $data[] = [ 
                                'kind' => 'MdxPage',
                                // 'file' => $name
                                'name' => str_replace(".mdx","",$name),
                                // todo get request file path;
                                'route' => "/$rPath/" . $finalRoute . str_replace(".mdx","",$name),

                                'time' => "$fileT",

                                "information" => "/$rPath/" . $finalRoute . "frontmatter.md",
                                //'route' => $path
                            ];
                        }

                        if (str_contains($name, 'index.html')) {
                            $fileT = filemtime($path);
                            $data[] = [ 
                                'kind' => 'HTMLPage',
                                // 'file' => $name
                                'name' => 'index.html',
                                // todo get request file path;
                                'route' => "/$rPath/" . $finalRoute,

                                'time' => "$fileT",

                                "cover" => "/$rPath/" . $finalRoute . "cover.png",

                                "information" => "/$rPath/" . $finalRoute . "frontmatter.md",
                                //'route' => $path
                            ];
                        }

                        if (str_contains($name, '_meta.json')) {
                            $jsonRawData = file_get_contents($path);
                            $jsonDecode = json_decode($jsonRawData);
                            // //$json = json_decode($jsonRawData, true);
                            // $result = [];
                            // foreach ($j as $jsonDecode) {
                            //     array_push($result,$j);
                            // }
                            $data[] = [ 
                                'kind' => 'Meta',
                                // 'file' => $name
                                'name' => '_meta.json',
                                'data' => $jsonDecode,
                                // todo get request file path;
                                //'route' => $path
                            ];

                        }

                    } else {
                            // Process the content of the directory.
                            $files = dir_to_array($path,$rPath,$folder);
    
                            $data[] = [ 'kind' => 'Folder',
                                        'name' => $name,
                                        'children'  => $files,
                                     ];
                            // A directory has a 'name' attribute
                            // to be able to retrieve its name.
                            // In case it is not needed, just delete it.
                    }
            }
    
            // Sorts files and directories if they are not on your system.
            \usort($data, function($a, $b) {
                    $aa = isset($a['file']) ? $a['file'] : $a['name'];
                    $bb = isset($b['file']) ? $b['file'] : $b['name'];
    
                    return \strcmp($aa, $bb);
            });
            return $data;
    }

    function dir_to_json($dir,$rPath,$folder)
    {
            $data = dir_to_array($dir,$rPath,$folder);
            //$data = json_encode($data);
            return $data;
    }

    $return_array = array('pageMap'=> dir_to_json($folder,$routerPath,$folder));
    echo json_encode($return_array);

    // // # function 1
    // $dir          = "/var/www/html/next/guideline";
    // $return_array = array();

    // function getDirContents($path) {
    //     $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
    //     $list = array(); //main array
        
    //     foreach ($rii as $file){
    //         //if (!$file->isDir()){
    //             if (str_contains($file, '.mdx')) {
    //                 $pfn = $file -> getPathname(); //PathFileName
    //                 $filted_pfn = str_replace("/var/www/html/next/guideline/","",$pfn); // Filt Out Root Dir
    //                 $deepth = substr_count($filted_pfn,'/'); // Get Folder Deepth
    //                 $name = (explode("/", $filted_pfn))[$deepth]; // Get FileName
    //                 $routeDelChar = "/" . $name; // Set Root Delete Char
                    
    //                 $finalRoute = ($deepth === 0) ? '' :  str_replace($routeDelChar,"",$filted_pfn) . '/';

    //                 $item = array(
    //                     'kind' => "MdxPage",
    //                     'name' => str_replace(".mdx","",$name),
    //                     'route' => '/posts/' . $finalRoute . str_replace(".mdx","",$name),  // $finalRoute
    //                     // 'filePath' => $pfn, // $name
    //                     'folder' => '/' . $finalRoute,
    //                     'deepth' => $deepth,
    //                 );
    //                 array_push($list,$item);
    //                 //$files[] = $filted_pfn;
    //             }
    //         //}
    //     }
    //     return $list;
    //     //return $files;
    // }

    // $return_array = array('files'=> getDirContents($dir));

    // echo json_encode($return_array);


file_put_contents('php://stdout', "---------------- POST List Dir Processing End ----------------\n");
?>