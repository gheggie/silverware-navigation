{$CSSID} ul.links > li > a {
<% if $IconColor %>  color: #{$IconColor};<% end_if %>
<% if $IconBackgroundColor %>  background-color: #{$IconBackgroundColor};<% end_if %>
<% if $IconMarginTopCSS %>  margin-top: {$IconMarginTopCSS};<% end_if %>
<% if $IconMarginLeftCSS %>  margin-left: {$IconMarginLeftCSS};<% end_if %>
<% if $IconMarginRightCSS %>  margin-right: {$IconMarginRightCSS};<% end_if %>
<% if $IconMarginBottomCSS %>  margin-bottom: {$IconMarginBottomCSS};<% end_if %>
}

<% loop $EnabledLinks %>
  
  <% if $HasColors %>
    {$Up.CSSID} ul.links > li > a{$CSSID} {
    <% if $IconColor %>  color: #{$IconColor};<% end_if %>
    <% if $IconBackgroundColor %>  background-color: #{$IconBackgroundColor};<% end_if %>
    }
  <% end_if %>
  
  {$Up.CSSID} ul.links > li > a{$CSSID}:focus,
  {$Up.CSSID} ul.links > li > a{$CSSID}:hover {
  <% if $IconHoverColor %>
    color: #{$IconHoverColor};
  <% else_if $Up.IconHoverColor %>
    color: #{$Up.IconHoverColor};
  <% end_if %>
  <% if $IconHoverBackgroundColor %>
    background-color: #{$IconHoverBackgroundColor};
  <% else_if $Up.IconHoverBackgroundColor %>
    background-color: #{$Up.IconHoverBackgroundColor};
  <% end_if %>
  }
  
  {$Up.CSSID} ul.links > li > a{$CSSID}:active {
  <% if $IconActiveColor %>
    color: #{$IconActiveColor};
  <% else_if $Up.IconActiveColor %>
    color: #{$Up.IconActiveColor};
  <% end_if %>
  <% if $IconActiveBackgroundColor %>
    background-color: #{$IconActiveBackgroundColor};
  <% else_if $Up.IconActiveBackgroundColor %>
    background-color: #{$Up.IconActiveBackgroundColor};
  <% end_if %>
  }
  
<% end_loop %>
