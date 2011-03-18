First steps
===========

1) Edit *locale/meta.config.sh*.

   Fill in the information about your project's
   name and version.


Updating localization files
===========================

Steps to update the localization files in case 
strings have changed in the source code:

1) ``./locale/extract.sh .``

   This will extract updated strings from the
   source code and put them in 
   *locale/templates/LC_MESSAGES/messages.pot*.

   Next, it will use that file to update ('merge')
   existing translations located in 
   *locale/**${locale_code}**/LC_MESSAGES/messages.po*.

2) ``svn commit locale/``

   This will send the updated localization files 
   to the SVN repository. Please note that this 
   may create conflicts for localizers who have
   been working on previous revisions of the
   localization files. Caution is advised.
   Please contact l10n-drivers if in doubt.

3) update the files in Verbatim

   This needs to be done manually. Yet another
   reason to contact l10n-drivers before you
   update the files :)



Steps to compile the localization files:
=======================================

1) ``./locale/compile.sh locale/``

   This will look for all *messages.po* files in
   the *locale/* directory and compile them to
   *messages.mo* files, used by the server.

   Please **do not commit *messages.mo* files** to 
   the SVN.



Steps to add a new locale:
==========================

1) ``./locale/add_locale.sh es es_ES.utf8``

   This will create required directories in 
   *locale/* and initialize the localization files.
   For argument explanations, invoke *add_locale.sh*
   with no arguments.
