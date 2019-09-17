# MVC-Framework

## Introduction
This project is currently being developed as a standalone framework, but will eventually 
be added as a sub section of my Pallet framework.


As the name suggests this is an MVC (Model View Controller) framework, it is built in 
PHP and designed to be quick and easy, in both terms of learning and implementing.


The framework is split into two main directories, `app` and `public`, these names can 
be changed if required, see the setup section below.


## How To Use
The first step to using the framework involves downloading the files from GitHub. The 
framework releases can be found [here] (https://github.com/smithymx67/MVC-Framework/releases).


This release contains all the files required for the framework to function correctly, 
the `app` directory is intended to be placed outside of the web servers document root, 
and the `public` directory is intended to be the document root.


All files in the `public` directory should be files intended to be accessible by the 
public, such as images, stylesheets and JavaScript files.


## Standard Setup
A standard setup is defined as having the `app` and `public` directories at the same 
level. The `public` directory will also be set as the servers document root.


With a standard setup, you should not need to modify any of the core files in order to 
get the framework working.


## Non-Standard Setup
A non standard setup is defined as having the `app` and `public` directories not placed 
at the same level. For example, the public directory may sit in a sub directory inside 
the document root.


The framework is flexible and allows for these non standard setups but some extra 
configuration is required to ensure it works correctly. Of course you can also change 
the names of the `app` and `public` directories, just make sure you reflect these 
changes in the core files.


Non-standard setup instructions can be found on the frameworks documentation site 
[here](https://www.smithymx67.co.uk/MVC-Public/).
