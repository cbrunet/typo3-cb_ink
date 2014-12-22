.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _configuration:

Configuration Reference
=======================

Most of the configuration is performed using TypoScript.

.. _configuration-typoscript:

TypoScript Constants
--------------------

All the properties are under ``plugin.tx_cbink``.

.. container::

    ====================== ============ ================================================= ========================================
    Constant               Type         Description                                       Default value
    ====================== ============ ================================================= ========================================
    htmlTemplate           file name    Name of the template for HTML emails              Newsletter.html
    plainText              file name    Name of the template for plain text emails        Newsletter.html
    view.templateRootPath  file path    Path to template files                            EXT:cb_ink/Resources/Private/Templates/
    view.partialRootPath   file path    Path to partial files                             EXT:cb_ink/Resources/Private/Partials/
    view.layoutRootPath    file path    Path to layout files                              EXT:cb_ink/Resources/Private/Layouts/
    siteURL                absolute url Absolute URL of the website (for links in emails) /
    ====================== ============ ================================================= ========================================


TypoScript Setup
----------------

HTML template
^^^^^^^^^^^^^

The TypoScript configuration for HTML rendering of emails is under ``tx_cbink_html``, which is of type :ref:`t3tsref:page`,
with **type=98**. ``tx_cbink_html.10`` is a :ref:`t3tsref:cobj-fluidtemplate` containing the email template.
The CSS inliner is called as a :ref:`t3tsref:stdwrap-postuserfunc` for this fluid template. This is why header codes
are disabled on this page, but rather included inside the provided layout.

By default, content columns 0, 1, 2, and 3 are available in the fluid template using variables ``content``, ``left``,
``right``, and ``border``. You can define any other content for your template, under ``tx_cbink_html.10.variables``.


A default template is provided (which only render the content column). You can define your own template,
by specifying the template file name in ``plugin.tx_cbink.htmlTemplate`` TypoScript constant,
and the template path in ``plugin.tx_cbink.view.templateRootPath`` constant. For more complex templates,
you could also specify a custom path for partials (``plugin.tx_cbink.view.partialRootPath`` constant).
Usually, you should not need to modify the dafault provided layout.

Plain text template
^^^^^^^^^^^^^^^^^^^

The setup for plain text template is under ``tx_cbink_plaintext``. It is based on the HTML template, but has page **type=99**.
The :ref:`t3tsref:stdwrap-postuserfunc` also is different, as it transforms HTML output to plain text.

By default, the fluid template used is the same as for HTML rendering. However, you could also specify a different template
using the ``plugin.tx_cbink.plainText`` TypoScript constant. 

html2text configuration
"""""""""""""""""""""""

The HTML to plain text converter is configured under ``tx_cbink_plaintext.10.stdWrap.postUserFunc``.


ignoreTags
    A list of HTML tags to ignore (content of those tags is stripped)

blockElements
    A list of HTML tags that are considered to be block elements (line break will be inserted before and after tag content)

*any HTML tag*
    A :ref:`t3tsref:stdWrap` that can be used to transform the content of this tag. See provided TypoScript setup for examples.

