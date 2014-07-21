<p align="justify">
Everywhere you can use the following
tags: <br>
<b>Subdomain-specific tags:</b>
%city%, %state%,
%subtrade1%, %subtrade2%, ...
%subtrade<i>N</i>%, where <i>N</i> >=1;
%subtrades% or %sub-trades% -- comma-separated
list of all subtrades;
%subdomain% -- subdomain name;
%subdomaincontent% -- the subdomain-specific content;<br>

<b>Trade-specific tags:</b>
%trade% or %Trade% (trade starting with uppercase);
you can include uploaded images as
&lt;img src="%img1%"&gt;
&lt;img src="%img2%"&gt;
&lt;img src="%img3%"&gt;
%tradecontent% -- the trade-specific content;
<br>


<b>General tags:</b>
%cities% -- comma-separated list of all
cities;
%trades% -- comma-separated list of all
trades;
%company% -- company title,
%domain% -- domain name,
%maincity% -- main city where the company acts,<br>

<b>Control tags:</b>
%universaltitle%;
%universalkeywords%;
%universaldescription%;
%templatecontent%. -- the general content for all the trades;
The template tag values can be changed
    using <a href="<?=site_url('subdomain/change_universals')?>">

        "settings"</a> page

<br><br>

<font color="red"> Note</font>, that the resulting
content for every subdomain will
consist of the following:<br>
&lt;div id="content"&gt;<br>
    %templatecontent%<br>
    %tradecontent%<br>
    %subdomaincontent%<br>
    &lt;/div&gt;<br>
</p>
