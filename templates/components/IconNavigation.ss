<% if $EnabledLinks %>
  <ul class="$ListClass">
    <% loop $EnabledLinks %>
      <li>$Me</li>
    <% end_loop %>
  </ul>
<% end_if %>