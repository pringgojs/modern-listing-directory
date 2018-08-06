<!doctype html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>Directory Contents</title>
    <link rel="stylesheet" href="http://localhost/assets/style.css">
    <script>
      function goBack() {
          window.history.back();
      }
    </script>
  </head>

  <body>
    <div style="clear:both"></div>
    <div style="width:50%">
    <button class="btn" onclick="goBack()">
      <img src="http://localhost/assets/back.png" alt="">
    </button>
      <h1>Directory Contents</h1>
      
      <?php
        // Opens directory
        $page='./'.@$_GET['p'];
        if (!$page) {
          $page = '.';
        }

        $myDirectory = opendir($page);
        // Gets each entry
        while ($entryName = readdir($myDirectory)) {
          $dirArray[] = $entryName;
        }

        // Finds extensions of files
        function findexts ($filename) {
            $filename = strtolower($filename);
            $exts = explode('.', $filename);
            $n = count($exts)-1;
            $exts = $exts[$n];
            return $exts;
        }

        // Closes directory
        closedir($myDirectory);
        // Counts elements in array
        $indexCount=count($dirArray);
        // Sorts files
        sort($dirArray);
        // Loops through the array of files
        for ($index=0; $index < $indexCount; $index++) {
          // Allows ./?hidden to show hidden files
          $hide = ".";
          $ahref = "./?hidden";
          $atext = "Show";
          if ($_SERVER['QUERY_STRING'] =="hidden") {
            $hide = "";
            $ahref = "./";
            $atext = "Hide";
          }

          if (substr("$dirArray[$index]", 0, 1) != $hide) {
            // Gets File Names
            $name = $dirArray[$index];
            $namehref = $dirArray[$index];
            // Gets Extensions 
            $extn = findexts($dirArray[$index]);
            // Gets file size 
            $size = number_format(@filesize($dirArray[$index]));
            // Gets Date Modified Data
            $modtime = date("M j Y g:i A", @filemtime($dirArray[$index]));
            $timekey = date("YmdHis", @filemtime($dirArray[$index]));
            // Prettifies File Types, add more to suit your needs.
            switch ($extn) {
              case "png": $extn = "png.png"; break;
              case "jpg": $extn = "jpg.png"; break;
              case "svg": $extn = "svg.png"; break;
              case "gif": $extn = "git.png"; break;
              case "ico": $extn = "ico.png"; break;
              case "txt": $extn = "txt.png"; break;
              case "log": $extn = "log.png"; break;
              case "htm": $extn = "html.png"; break;
              case "php": $extn = "php.png"; break;
              case "js": $extn = "js.png"; break;
              case "css": $extn = "css.png"; break;
              case "pdf": $extn = "pdf.png"; break;
              case "zip": $extn = "zip.png"; break;
              case "bak": $extn = "bak.png";break;
              default: $extn = "file.png"; break;
            }
            
            // Separates directories
            if (is_dir($dirArray[$index])) {
              $extn = "dir.png";
              $size = "-";
            }
            
            // Cleans up . and .. directories 
            if ($name == ".") {
              $name = ". (Current Directory)";
              $extn = "dir.png";
            }

            if ($name == "..") {
              $name = ".. (Parent Directory)";
              $extn = "dir.png";
            }
            echo '
              <a href="'.$namehref.'"><div class="card"><img src="http://localhost/assets/png/'.$extn.'" class="avatar" alt="Avatar">
                <div class="containers"><h4 class="title"><b>'.$name.'</b></h4><p class="date">'.$modtime.'</p><p class="size">'.$size.' bytes</p></div></div>
              </a>';
          }
        }
      ?>
        <div style="clear:both"></div>
        <h2 style="margin-top:20px; border-top: 2px solid #000; padding: 10px">
          <?php print("<a href='$ahref'>$atext hidden files</a>"); ?>
        </h2>
    </div>
  </body>

</html>