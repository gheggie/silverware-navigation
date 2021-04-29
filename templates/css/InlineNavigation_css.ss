<% if $LinkMarginCSS %>

@media (min-width: 750px) {
  
  {$CSSID} ul.links.wide-left > li {
    margin-right: {$LinkMarginCSS};
  }
  
  {$CSSID} ul.links.wide-center > li {
    margin: 0 {$LinkHalfMarginCSS};
  }
  
  {$CSSID} ul.links.wide-right > li {
    margin-left: {$LinkMarginCSS};
  }
  
}

<% end_if %>