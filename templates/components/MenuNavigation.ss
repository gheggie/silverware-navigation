<div class="menu">
  <div class="bar">
    <button class="$ButtonClass" type="button" aria-label="Menu" aria-controls="navigation">
      <span class="hamburger-box">
        <span class="hamburger-inner"></span>
      </span>
      <% if $ButtonLabelShown %>
        <span class="hamburger-label">$ButtonLabel</span>
      <% end_if %>
    </button>
  </div>
  <nav class="nav">
    <ul id="$ListID" class="$ListClass">
      <% loop $Menu(1) %>
        <% include MenuNavigation_Item ShowSubMenus=$Top.ShowSubMenus %>
      <% end_loop %>
    </ul>
  </nav>
</div>