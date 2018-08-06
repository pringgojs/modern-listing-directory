# modern-listing-directory
Modern listing directory project in htdocs. With this code you can modified view of list folder project with modern style. Enjoy it!

![Alt text](/assets/Screenshot.png?raw=true "Screenshot")

## Installation
1. Clone this repo
2. Move to the root directory inside `htdocs`
3. Try in `http://localhost`

## Setup to Child of Directory (Sub Folder)
Create file `index.php` in your sub directory.
``` <?php echo file_get_contents('http://localhost/index.php?p=client'); ``` 
`client` is your path subfolder. If you have multiple child folder, just modified params `p` like this :
`p=[subfolder]/[subfolder]/[subfolder]`.

Enjoyit
