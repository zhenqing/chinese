<div id="sub_sidebar">
            <div id="sub_sidebar">
            <h2 class="title">耶青动向</h2>
            <!-- side_menu start-->
            <ul id="side_menu"> 
                <li <?=$specialid ==81 ? 'class="current"' : '' ?>><a href="/chinese/pulse/index.htm">发展</a></li>
                <li <?=$specialid ==82 ? 'class="current"' : '' ?>><a href="/chinese/pulse/devotional.htm">灵修小品</a></li>
                <li <?=$specialid ==83 ? 'class="current"' : '' ?>><a href="/chinese/pulse/outreach.htm">校园拓展</a></li>
                <li <?=$specialid ==84 ? 'class="current"' : '' ?>><a href="/chinese/pulse/ydtoday.htm">今日耶青</a></li>
            </ul>
            </div>
            <!-- side_menu end-->
            <!-- explore start -->
            <? include "../templates/explore.tpl";?>
            <!-- explore end -->
            <!-- subbox start -->
            <? include "../templates/subbox.tpl";?>
            <!-- subbox end -->
        </div>
