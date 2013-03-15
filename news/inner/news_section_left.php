        <div id="sub_sidebar">
            <div id="sub_sidebar">
            <h2 class="title">新闻中心</h2>
            <!-- side_menu start-->
            <ul id="side_menu"> 
                <li <?=$specialid ==69 ? 'class="current"' : '' ?>><a href="/chinese/news/church.htm">教会新闻</a></li>
                <li <?=$specialid ==70 ? 'class="current"' : '' ?>><a href="/chinese/news/global.htm">国际新闻</a></li>
                <li <?=$specialid ==71 ? 'class="current"' : '' ?>><a href="/chinese/news/society.htm">社会新闻</a></li>
                <li <?=$specialid ==72 ? 'class="current"' : '' ?>><a href="/chinese/news/marry.htm">婚恋新闻</a></li>
                <li <?=$specialid ==73 ? 'class="current"' : '' ?>><a href="/chinese/news/culture.htm">文化新闻</a></li>
                <li <?=$specialid ==74 ? 'class="current"' : '' ?>><a href="/chinese/news/business.htm">商业新闻</a></li>
            </ul>
        </div>
        
            <!-- explore start -->
            <? include "../templates/explore_differ.tpl";?>
            <!-- explore end -->
            <!-- subbox start -->
            <? include "../templates/subbox.tpl";?>
            <!-- subbox end -->
        </div>
