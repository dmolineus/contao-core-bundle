# Contao core bundle change log

### 4.2.5 (2016-10-27)

 * Unlock members after password change (see contao/core#8545).
 * Register an alias for the language fallback page model (see contao/core#8544).
 * Correctly calculate the maximum length of tl_files.name (see contao/core#8536).
 * Correctly add the headline if a content element is versionized (see contao/core#8502).
 * Optimize the DCA sorting filter for date fields (see contao/core#8485).
 * Do not show version entries of deleted files (see contao/core#8480).
 * Redirect the empty URL depending on language and alias name (see contao/core#8498).
 * Apply `specialchars()` to widget attributes (see contao/core#8505).
 * Queue the requests when rebuilding the search index (see contao/core#8449).
 * Correctly determine the form field names in the file manager (see #600).
 * Correctly show the maximum file size in the form upload widget (see #595).
 * Correctly encode e-mail addresses in the text element (see #594).
 * Do not parse front end templates twice (see #599).
 * Correctly set host and scheme in the URL generator (see #592).
 * Correctly reload the page and file trees in "edit multiple" mode.
 * Correctly normalize the paths in the symlink command.

### 4.2.4 (2016-09-21)

 * Handle special character passwords in the "close account" module (see contao/core#8455).
 * Handle broken SVG files in the Image and File class (see contao/core#8470).
 * Reduce the maximum field length by the file extension length (see contao/core#8472).
 * Fall back to the field name if there is no label (see contao/core#8461).
 * Do not assume NULL by default for binary fields (see contao/core#8477).
 * Correctly render the diff view if not the latest version is active (see contao/core#8481).
 * Update the list of countries and languages (see contao/core#8453).
 * Correctly set up the MooTools CDN URL (see contao/core#8458).
 * Also check the URL length when determining the search URL (see contao/core#8460).
 * Only regenerate the session ID upon login.

### 4.2.3 (2016-09-06)

 * Do not double URL encode the content syndication links.
 * Use CSS3 transforms instead of transitions to animate the off-canvas navigation.
 * Improve the exception handling when using the resource locator (see #557).
 * Correctly reset the filter menu in parent view.
 * Support all characters but =!<> and whitespace in simple tokens (see contao/core#8436).
 * Check the user's permission when generating links in the picker (see contao/core#8407). 
 * Handle forward pages without target in the navigation modules (see contao/core#8377).
 * Provide the same template variables for downloads and enclosures (see contao/core#8392).
 * Handle %n when parsing date formats (see contao/core#8411).
 * Fix the module wizard's accessibility (see contao/core#8391).
 * Correctly initialize TinyMCE in sub-palettes in Firefox (see contao/core#3673).
 * Validate form field names more accurately (see contao/core#8403).
 * Correctly show the ctime, mtime and atime of a folder (see contao/core#8408).
 * Correctly index changed pages (see contao/core#8439).

### 4.2.2 (2016-07-28)

 * Adjust the command scheduler default configuration.
 * Check if the tl_cron table exists in the command scheduler (see #541).
 * Correctly merge the legacy headers so front end users can log in again.

### 4.2.1 (2016-07-15)

 * Strip soft hyphens when indexing a page (see contao/core#8389).
 * Do not run the command scheduler if the installation is incomplete (see #541).
 * Do not index randomly ordered image galleries.
 * Fix the filter menu layout on mobile devices.
 * Provide the back end fonts in different variants (see #523).
 * Fix the message markup in the member templates.
 * Correctly load the language strings in the pretty error screen listener.

### 4.2.0 (2016-06-18)

 * Also check for the back end cookie when loading from cache (see contao/core#8249).
 * Unset "mode" and "pid" upon save and edit (see contao/core#8292).
 * Always use the relative path in DC_Folder (see contao/core#8370).
 * Use the correct empty value when resetting copied fields (see contao/core#8365).
 * Remove the "required" attribute if a subpalette is closed (see contao/core#8192).
 * Correctly calculate the maximum file size for DropZone (see contao/core#8098).
 * Versionize and show password changes (see contao/core#8301).
 * Make File::$dirname an absolute path again (see contao/core#8325).
 * Store the full URLs in the search index (see #491).
 * Standardize the group names in the checkbox widget (see contao/core#8002).
 * Prevent models from being registered twice (see contao/core#8224).
 * Prevent horizontal scrolling in the ACE editor (see contao/core#8328).
 * Correctly render the breadcrumb links in the template editor (see contao/core#8341).
 * Remove the role attributes from the navigation templates (see contao/core#8343).
 * Do not add `role="tablist"` to the accordion container (see contao/core#8344).
 * Handle the `useAutoItem` option in the URL generator (see #489).
 * Correctly implement the "autoplay" option in the YouTube/Vimeo element (see #509).
 * Show the system messages in a modal dialog (see #486).
 * Make DropZone the default uploader in the file manager (see #504).
 * Correctly aling the input hints (see #503).
 * Disable the "preview as" button if a member is not allowed to log in (see #502).
 * Remove the "type" attribute from the Youtube/Vimeo iframe tag.
 * Fix the filter reset buttons (see #496).
 * Fix the filename case of the new SVG icons (see #492).

### 4.2.0-RC1 (2016-05-18)

 * Add the URI when throwing 403 and 404 exceptions (see #369).
 * Correctly determine the script_name in the Environment class (see #426).
 * Add the URL generator (see #480).
 * Support subpalettes in subpalettes (see #450).
 * Add keys to the cronjobs array (see #440).

### 4.2.0-beta1 (2016-04-25)

 * Remove the internal cache routines from the maintenance module (see #459).
 * Modernize the back end theme and use SVG icons (see contao/core#4608).
 * Add the PaletteManipulator class to modify DCA palettes (see #474).
 * Optimize the jQuery and MooTools templates (see contao/core#8017).
 * Show the record ID and table name in the diff view (see contao/core#5800).
 * Add a "reset filters" button (see contao/core#6239).
 * Support filters in the tree view (see contao/core#7074).
 * Recursively replace insert tags (see #473).
 * Add the Vimeo content element (see contao/core#8219).
 * Improve the YouTube element (see contao/core#7514).
 * Update the Piwik tracking code (see contao/core#8229).
 * Use instanceof to check the return value of Model::getRelated() (see #451).
 * Use the Composer class loader to load the Contao classes (see #437).
 * Add the "ignoreFePreview" flag to the model classes (see #452).
 * Clean up the code of the file selector (see #456).
