.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _admin-manual:

Administrator Manual
====================



.. _admin-installation:

Installation
------------

This extension does not have any special dependencies.
We use it along with `Direct Mail`_. However, it should
be possible to use it also with other mail systems.

You should install the static template. It can be included at the root of
you website, or only in the folder used for generating mails. If you use
`Direct Mail`_, you should include *Direct Mail Content Boundaries* static
template before it. You should **not** inluce *Direct Mail Plain Text* or
*Direct Mail News Plain Text* templates, as *cb_ink* provides a different
way of generating plain text version of the email.



.. _admin-configuration:

Configuration
-------------

The important configuration to be performed is to specify the absolute URL
for links in emails. You can do it in the TypoScript constant editor.

Absolute URL for links [plugin.tx_cbink.siteURL]:
    Url of you website (e.g. http://example.com/). Do not forget the trailing /.

See :ref:`configuration` for more details.

Direct Mail
^^^^^^^^^^^

cb_ink extension configures a special page type, both for HTML (type=98)
and for plain text (type=99) rendering of emails. Therefore, it is important to 
tell `Direct Mail`_ to fetch the page with the right page type. In the configuration
module of Direct Mail, under the *Set default values for mail content fetching options:* tab,
the *Parameters, HTML:* option must be set to **&type=98**, while the *Parameter, Plain text:*
option must remain **&type=99**.



.. _Direct Mail: http://typo3.org/extensions/repository/view/direct_mail
