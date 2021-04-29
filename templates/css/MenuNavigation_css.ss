<% if $MenuBackgroundColorCSS %>
  
  {$CSSID} div.menu {
    background-color: {$MenuBackgroundColorCSS};
  }
  
<% end_if %>

<% if $ButtonBackgroundColorCSS %>
  
  {$CSSID} .sm-button,
  {$CSSID} ul.sm-default a span.sub-arrow {
    background-color: {$ButtonBackgroundColorCSS};
  }
  
<% end_if %>

<% if $ButtonBackgroundHoverColorCSS %>
  
  {$CSSID} .sm-button:hover,
  {$CSSID} .sm-button:focus,
  {$CSSID} ul.sm-default a span.sub-arrow:hover,
  {$CSSID} ul.sm-default a span.sub-arrow:focus {
    background-color: {$ButtonBackgroundHoverColorCSS};
  }
  
<% end_if %>

<% if $ButtonBackgroundActiveColorCSS %>
  
  {$CSSID} .sm-button.is-active,
  {$CSSID} ul.sm-default a.highlighted span.sub-arrow {
    background-color: {$ButtonBackgroundActiveColorCSS};
  }
  
<% end_if %>

<% if $ButtonForegroundColorCSS %>
  
  {$CSSID} .sm-button .hamburger-inner,
  {$CSSID} .sm-button .hamburger-inner::after,
  {$CSSID} .sm-button .hamburger-inner::before {
    background-color: {$ButtonForegroundColorCSS};
  }
  
  {$CSSID} .sm-button .hamburger-label {
    color: {$ButtonForegroundColorCSS};
  }

<% end_if %>

<% if $MenuFontFamilyCSS %>
  
  {$CSSID} ul.sm-default {
    font-family: {$MenuFontFamilyCSS};
  }
  
<% end_if %>

{$CSSID} .sm-button .hamburger-label {
  <% if $ButtonFontSizeCSS %>  font-size: {$ButtonFontSizeCSS};<% end_if %>
  <% if $ButtonFontFamilyCSS %>  font-family: {$ButtonFontFamilyCSS};<% end_if %>
}

<% if $MobileForegroundColorCSS %>
  
  {$CSSID} ul.sm-default a,
  {$CSSID} ul.sm-default a:hover,
  {$CSSID} ul.sm-default a:focus,
  {$CSSID} ul.sm-default a:active {
    color: {$MobileForegroundColorCSS};
  }
  
  {$CSSID} ul.sm-default a span.sub-arrow {
    color: {$MobileForegroundColorCSS};
  }

<% end_if %>

<% if $MobileBackgroundActiveColorCSS %>
  
  {$CSSID} ul.sm-default a:hover,
  {$CSSID} ul.sm-default a:focus,
  {$CSSID} ul.sm-default a:active {
    background-color: {$MobileBackgroundActiveColorCSS};
  }
  
<% end_if %>

<% if $MobileFontSizeCSS %>
  
  {$CSSID} ul.sm-default a {
    font-size: {$MobileFontSizeCSS};
  }
  
<% end_if %>

@media (min-width: 750px) {
  
  <% if $TopLevelForegroundColorCSS %>
    
    {$CSSID} ul.sm-default a,
    {$CSSID} ul.sm-default a:hover,
    {$CSSID} ul.sm-default a:focus,
    {$CSSID} ul.sm-default a:active,
    {$CSSID} ul.sm-default a.highlighted {
      color: {$TopLevelForegroundColorCSS};
    }
    
    {$CSSID} ul.sm-default > li.current > a,
    {$CSSID} ul.sm-default > li.section > a {
      color: {$TopLevelForegroundColorCSS};
    }
    
    {$CSSID} ul.sm-default a span.sub-arrow,
    {$CSSID} ul.sm-default a.highlighted span.sub-arrow,
    {$CSSID} ul.sm-default li.current > a span.sub-arrow,
    {$CSSID} ul.sm-default li.section > a span.sub-arrow {
      border-color: {$TopLevelForegroundColorCSS} transparent transparent transparent;
    }
    
  <% end_if %>
  
  <% if $TopLevelBackgroundActiveColorCSS %>
    
    {$CSSID} ul.sm-default a:hover,
    {$CSSID} ul.sm-default a:focus,
    {$CSSID} ul.sm-default a:active,
    {$CSSID} ul.sm-default a.highlighted {
      background-color: {$TopLevelBackgroundActiveColorCSS};
    }
    
    {$CSSID} ul.sm-default > li.current > a,
    {$CSSID} ul.sm-default > li.section > a {
      background-color: {$TopLevelBackgroundActiveColorCSS};
    }
    
  <% end_if %>
  
  {$CSSID} ul.sm-default ul {
  <% if $SubMenuBorderCSS %>  border: {$SubMenuBorderCSS};<% end_if %>
  <% if $SubMenuBackgroundColorCSS %>  background-color: {$SubMenuBackgroundColorCSS};<% end_if %>
  }
  
  <% if $SubLevelForegroundColorCSS %>
    
    {$CSSID} ul.sm-default ul a,
    {$CSSID} ul.sm-default ul a:hover,
    {$CSSID} ul.sm-default ul a:focus,
    {$CSSID} ul.sm-default ul a:active,
    {$CSSID} ul.sm-default ul a.highlighted {
      color: {$SubLevelForegroundColorCSS};
    }
    
    {$CSSID} ul.sm-default ul a span.sub-arrow,
    {$CSSID} ul.sm-default ul a.highlighted span.sub-arrow,
    {$CSSID} ul.sm-default ul li.current > a span.sub-arrow,
    {$CSSID} ul.sm-default ul li.section > a span.sub-arrow {
      border-color: transparent transparent transparent {$SubLevelForegroundColorCSS};
    }
    
  <% end_if %>
  
  <% if $SubLevelBackgroundActiveColorCSS %>
    
    {$CSSID} ul.sm-default ul a:hover,
    {$CSSID} ul.sm-default ul a:focus,
    {$CSSID} ul.sm-default ul a:active,
    {$CSSID} ul.sm-default ul a.highlighted {
      background-color: {$SubLevelBackgroundActiveColorCSS};
    }
    
  <% end_if %>
  
  <% if $TopLevelFontSizeCSS %>
    
    {$CSSID} ul.sm-default a {
      font-size: {$TopLevelFontSizeCSS};
    }
    
  <% end_if %>
  
  <% if $SubLevelFontSizeCSS %>
    
    {$CSSID} ul.sm-default ul a,
    {$CSSID} ul.sm-default ul a:hover,
    {$CSSID} ul.sm-default ul a:focus,
    {$CSSID} ul.sm-default ul a:active,
    {$CSSID} ul.sm-default ul a.highlighted {
      font-size: {$SubLevelFontSizeCSS};
    }
    
  <% end_if %>
  
}
