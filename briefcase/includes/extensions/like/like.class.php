<?php

class Like {

    var $nameFile = "like.tmp";
    var $directory = "wp-content/themes/briefcase/includes/extensions/like/";
    var $changeClass = array(
        "like" => array("like-disable", "like-enable"),
        "porto" => array("porto-disable", "porto-enable")
    );

    /*
     *  arraycare se va salva in fisier are forma :
     *  $array = array('id_post'=>  array(), 'value' => array('ip', 'vote'));
     */

    function createFile() {
        $array = array('ip' => array(), 'like' => array('post' => array(), 'vote' => array()));
        $this->saveFile($this->nameFile, $array);
    }

    function addToFile($post, $vote) {
        $array = $this->readFileAjax($this->nameFile);
        print_r($array);
        // verificam daca utilizatorul  a votat macar odata 
        $ip_exist = false;
        $key = null;
        for ($i = 0; $i < count($array['ip']); $i++) {
            if ($array['ip'][$i] == $_SERVER['REMOTE_ADDR']) {
                $ip_exist = true;
                $key = $i;
            }
        }

        //incepem sa adaugam voturile
        if ($vote == "plus") {
            //daca utilizatorul este pentru prima data   si apasat vot , trebuie adaugat in array
            if ($ip_exist == false) {
                array_push($array['ip'], $_SERVER['REMOTE_ADDR']);
                $key = array_search($_SERVER['REMOTE_ADDR'], $array['ip']);
                array_push($array['like'], array("post" => array($post), "vote" => array("1")));
            }
            // intra in else numai atuncea ,  cind dejaa mai dat like la produse
            else {
                //verificam daca a mai are like la acest produs
//                if (in_array($post, $array['like'][$key]['post'])) {
////se adauga daca utilizatorul nu a dat like la produs
//                    $key_v = array_search($post, $array['like'][$key]['post']);
//                    //se adauga daca utilizatorul nu a dat like la produs
//                    array_push($array['like'][$key], array("post" => $post, "vote" => "1"));
//                    $array['like'][$key]['post'][$key_v] = $post;
//                    $array['like'][$key]['vote'][$key_v] = "1";
//                } else {
                    //daca utilizatoru face primadata like la prost
                    array_push($array['like'][$key]['post'], $post);
                    array_push($array['like'][$key]['vote'], "1");
                //}
            }
        }
        if ($vote == "minus") {
            $key_v = array_search($post, $array['like'][$key]['post']);
            //se adauga daca utilizatorul nu a dat like la produs
            unset($array['like'][$key]['post'][$key_v]);
            unset($array['like'][$key]['vote'][$key_v]);
            $array['like'][$key]['post'] = array_values($array['like'][$key]['post']);
            $array['like'][$key]['vote'] = array_values($array['like'][$key]['vote']);
            // verificam daca  sunt 0 voturi pentru acest post
            if(count($array['like'][$key]['post'])==0){
                //unset($array['like'][$key]);
            }
        }

        $this->saveFileAjax($this->nameFile, $array);
    }

    function readFile($nameFile) {
        // return filesize($this->directory . "" . $nameFile);
        $fh = fopen($this->directory . "" . $nameFile, 'r') or die("Can't open file");
        $string = unserialize(fread($fh, filesize($this->directory . "" . $nameFile)));
        fclose($fh);
        return $string;
    }

    function readFileAjax($nameFile) {
        $fh = fopen("" . $nameFile, 'r') or die("Can't open file");
        $string = unserialize(fread($fh, filesize("" . $nameFile)));
        fclose($fh);
        return $string;
    }

    function saveFile($nameFile, $array) {
        $ourFileHandle = fopen($this->directory . "" . $nameFile, 'w') or die("can't open file");
        fwrite($ourFileHandle, serialize($array));
        fclose($ourFileHandle);
    }

    function saveFileAjax($nameFile, $array) {
        $ourFileHandle = fopen("" . $nameFile, 'w') or die("can't open file");
        fwrite($ourFileHandle, serialize($array));
        fclose($ourFileHandle);
    }

    function gen_like($id_post, $post_type) {
       
        if (!file_exists($this->directory . "" . $this->nameFile)) {
            $this->createFile();
        }
        //$id_post = the_ID();
        $array = $this->readFile($this->nameFile);
       // echo "<pre>";
       // print_r($array);
        $status_like = false;
        for ($i = 0; $i < count($array['ip']); $i++) {
            // daca utilizatoru a mai dat like
            if ($array['ip'][$i] == $_SERVER['REMOTE_ADDR']) {
                for ($j = 0; $j < count($array['like'][$i]['post']); $j++) {
                    if ($array['like'][$i]['post'][$j] == $id_post) {
                        $status_like = true;
                    }
                }
            }
        }
        // calculam numarul de visualizari 
        $raiting = 0;
        for ($i = 0; $i < count($array['ip']); $i++) {
            for ($j = 0; $j < count($array['like'][$i]['post']); $j++) {
                if ($array['like'][$i]['post'][$j] == $id_post) {
                    $raiting = $raiting + $array['like'][$i]['vote'][$j];
                }
            }
        }


        $like_class = "";
        $class = "";
        //======================
        if ($status_like) {
            if ($post_type == "portfolio") {
                $class = $this->changeClass['porto'][0];
                $like_class = "single-portfolio";
            } else {
                $class = $this->changeClass['like'][0];
                $like_class = "home";
            }
        } else {
            if ($post_type == "portfolio") {
                $like_class = "single-portfolio";
                $class = $this->changeClass['porto'][1];
            } else {
                $like_class = "home";
                $class = $this->changeClass['like'][1];
            }
        }
        echo  '<div class="like-container ' . $like_class . '" > 
               <div id="' . $id_post . '" class="' . $class . '">
                 
               </div> 
               <span class="like-counter">
                  <strong>' . $raiting . '</strong>
               </span> 
            </div>';
        
//    <div class="like-container single/single portfolio/home/blog">
//     <div id="254" class="like-enable sau disable">
//        <div class="heart-zoom"></div>
//     </div><!--end like-enable sau disable-->
//     
//     <div class="like-counter">
//        <strong>12</strong>
//     </div><!--end like-counter-->
//</div><!--end like-container-->
    }

}

$like = new Like();
// Primirea postului de la utilizator cind face like 
if (isset($_POST['vote']) && isset($_POST['post']) && $_POST['post'] != "" && $_POST['vote'] != "") {
    $like = new Like();
    $like->addToFile($_POST['post'], $_POST['vote']);
    exit();
}

// generarea 
