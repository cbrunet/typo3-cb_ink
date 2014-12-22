.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _introduction:

Introduction
============


.. _what-it-does:

What does it do?
----------------

This extension provides CSS file from `Zurb Ink`_ responsive email template, along with
tools aimed to help building email templates, both in HTML and in plain text, to use
with mass mailers, such as `Direct Mail`_.

It includes a CSS inliner, i.e. a tool converting CSS styles into inline style attributes in your HTML code.
This ensures proper display on email and mobile device readers that lack stylesheet support.
This CSS inliner is based on Emogrifier_.

It also includes a tool to convert HTML code into plain text, based on html2text_. `Direct Mail`_ already includes such
a tool; however, it is limited to a few types of content records. The converter included here use a
different approach and should work with any kind of content records.

To see this extension in action, simply includes the static template, then append *&type=98* to a page URL,
to see the HTML email version of the page, or *&type=99* to see the plain text email version of the page.


Included resources
------------------

.. container::

    ========== ======= ========================================
    Resource   Version Website
    ========== ======= ========================================
    Zurb Ink   1.0.5   http://zurb.com/ink/
    Emogrifier 0.1     https://github.com/jjriv/emogrifier
    html2text  0.2     https://github.com/soundasleep/html2text
    ========== ======= ========================================

Repository, bug tracker, etc.
-----------------------------

Code repository, bug tracker, and related tools can be found on GitHub_.


.. _Zurb Ink: http://zurb.com/ink/
.. _Direct Mail: http://typo3.org/extensions/repository/view/direct_mail
.. _Emogrifier: https://github.com/jjriv/emogrifier
.. _html2text: https://github.com/soundasleep/html2text
.. _GitHub: https://github.com/cbrunet/typo3-cb_ink

