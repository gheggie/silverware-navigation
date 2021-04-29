<% if $CurrentLevel %>
  <ul class="$ListClass">
    <% loop $CurrentLevel %>
      <li class="$LinkingMode">$Up.FontIconTag<a href="$Link" title="$MenuTitle"><span>$MenuTitle</span></a></li>
    <% end_loop %>
  </ul>
<% end_if %>