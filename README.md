# Groupdocs Viewer for .NET
============================

GroupDocs Viewer for .NET plugin for ezPublish

With GroupDocs Viewer for .NET plugin for ezPublish you can easily view on [annotate on PDF's](http://groupdocs.com/apps/Viewer), Word documents, Excel documents, Powerpoint documents and more with the GroupDocs Viewer tool, directly from within your ezPublish website.

###Plugin Manual Installation Instructions:
1. "groupdocsViewerNet" module contain "design, modules, setting", so unzip it into "extentions" directory, so parent directory is "groupdocsViewer"
2. Open file: "site/settings/override/site.ini.append.php" and add "ActiveExtensions[]=groupdocsViewerNet" under "[ExtensionSettings]"
3. Go to Admin > Setup > Extentions and checkbox where "groupdocsViewer" must be ticked
4. Then go to - Setup > Extentions and press "Regenerate autoloaded arrays for extentions" in the bottom
5. Grant permissions in admin go to - User Accounts > Roles and policies > Anonymous => Edit Role and if "groupdocsViewerNet" isn't available in the list press - New Policy > choose Module: groupdocsViewerNet > Grant access to all functions > Save
6. Go to Setup and press "Clear all caches"


###[Sign, Manage, Annotate, Assemble, Compare and Convert Documents with GroupDocs](http://groupdocs.com)
* [View PDF, Word, Excel, Powerpoint and Images with GroupDocs.Viewer for .NET Library](http://groupdocs.com/dot-net/document-viewer-library)
* [See GroupDocs Viewer for .NET plugin for ez Publish CMS](https://github.com/groupdocs/ezpublish-groupdocs-viewer-dotnet)

###Created by [GroupDocs Marketplace Team](http://groupdocs.com/marketplace/).