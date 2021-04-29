<li class="$LinkingMode">
  <a href="$Link" class="$LinkingMode" title="$MenuTitle"><span>$MenuTitle</span></a>
  <% if $ShowSubMenus %>
    <% if $Children %>
      <ul>
        <% loop $Children %>
          <% include MenuNavigation_Item ShowSubMenus=$Top.ShowSubMenus %>
        <% end_loop %>
      </ul>
    <% end_if %>
  <% end_if %>
</li>