# Web Project Template

This is a template for new web development projects. It uses Node.js and Gulp to create sourcemaps 
and minify and optimize files from a source directory to a build directory, which can then be copied 
to a server.


## How to use
First take a copy of the repository and place the files in the project directory on your system.

### Install Composer
#### Linux
`sudo apt-get update`

`sudo apt-get install curl`

`sudo curl -s https://getcomposer.org/installer | php`

`sudo mv composer.phar /usr/local/bin/composer`


### Install Node.js
Now that you have the files locally, it's time to install all the items we need. For Gulp to 
function you need to have Node.js installed, this project was built using the LTS version (v10).
Follow the link and download [Node.js](https://nodejs.org/en/download/).


### Install Gulp
Now that you have Node.js installed it's time to install Gulp. Open up a Terminal or 
CMD/Powershell window and run the following commands. These may need to be run as an admin.

`npm install gulp -g`

`npm install gulp-cli -g`


### Initilize the project
Point the Terminal or CMD/Powershell window to the location that contains the project files.
Run the following command to initialize the project. This will install the files needed for 
Gulp to function.

`npm install`


### Running Gulp
Now that everything is in place it's time to run Gulp. Make sure that your Terminal or 
CMD/Powershell window is pointing to the project directory. Run one of the following commands.

`gulp build` - Clears the build directory and re-builds the project (Good for removing old files)

`gulp watch` - Watches the files as you code, when a change is detected it will trigger linked task


### Start coding
You will find that there are two directories, `src` and `build`. Place all your source files in the 
`src` directory, these files will then be copied to the `build` directories apon saving.

If new files are created, you may need to restart Gulp by killing the watch process and rerun 
`gulp watch`.

#### SCSS
Add stylesheets to the directory `src/public/styles`. Gulp will create sourcemaps, minify and copy the 
files to the `build/public/styles` directory automatically.

#### Javascript
Add Javascript files to the directory `src/public/scripts`. Gulp will create sourcemaps, minify and copy 
the files to the `build/public/scripts` directory automatically.

#### Images
Add image files to your directory `src/public/images`. Gulp will copy the files to the `build/public/images` 
directory automatically.