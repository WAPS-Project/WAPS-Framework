# Changelog

## 1.5.2

### Mobile display Bug

Fixed an issue that prevented scaling of menu items.

## 1.5.1

### Webpack optimization

A few optimizations were made to the Webpack config to improve the compilation, in addition packets were updated

### Routing Bug

A routing bug was fixed, which prevented the login and the user settings page from loading


## 1.5.0

### Various bug fixes

### New Config File Head
Changed structure of the config file head.

### XML/JSON converter
A class, that provides methods for 
converting `json` strings into `xml` strings and back.

### SCSS to SASS rework
Reworking `SCSS` code to `SASS` code.

### Removal of the sample age system


## 1.4.0

### Various bug fixes

### Adding migration system
Adding a Migration System to automize Database migrations.

### User Config Page
Adding a User Config System the enables Users to manage their Data.
It was built dynamically and can be expanded quickly if necessary.

### A new Loader System
Due to the necessity of asynchronous commands, the loader system was adapted to different scripts.

### Crash Log System for the Error Handler
Adding a Crash log system, that writes Log files.

### Deploy CLI
We have added the option for the automated deployment of projects, which required changes to the structure of the project folder.

### Menue Wrapper
Adding a function based on the Page Files Meta head to automatically generate Sub Menu's.


## 1.3.0

### Add heading selector
Adding a selection if the h1 should be generated or not.

### Database Check
Adding a Database Check at startup to validate that all tables are set.

### Query improvements
There were some sql query improvements made.

### Style improvements
A complete new Style and Logo added.
 
### Plugin Support
A new Plugin System was added, external plugins can now be implemented easy by just drag and drop them.

### View/Core Refactoring
The view Pages for the Header, Head and Footer are now in the ```./page/view/``` folder, future views will be stored there.

### Documentation rewrite
A new startup Documentation was added to the Project.

## 1.2.1

### Buf Fix: IP Logger
Fixing the broken IP Logger

## 1.2.0

### Reworking the config Loader
The config Loader is now able to generate constants by itself based on the config file.

### Adding a User Account System
The user registration and login is now implemented.

### Fixing the broken Framework imports
The broken Webpack compilation is now fixed.

### Framework updates
There are multiple framework updates,
including bootstrap, jquery and sweetalert2