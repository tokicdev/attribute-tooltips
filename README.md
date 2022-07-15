## Customisable CSS on-hover tooltips

Attach a tooltip onto any HTML element just by adding a HTML attribute.
You can customise the tooltip location (up, left, right, bottom), tooltip color, text color, text size and hover transition speed.
See [the example](https://htmlpreview.github.io/?https://github.com/Toxic48/attribute-tooltips/blob/main/example.html) for a preview.


## **Installation**

Simply include the 'tooltip.js' in the head of your HTML file:

```
<script src="tooltip.js"></script>
```


You can also include just 'tooltip.css' to your HTML file, but then you will only be able to customize tooltips location. Including 'tooltip.js' gives you more customising abilities.

## **Usage**

To add a tooltip onto any HTML element simply add the attribute '**data-tooltip-text**' on the element, and assign the attribute value with any text you want the tooltip to display on hover:

```
<div data-tooltip-text="Tooltip text">
    HTML element
</div>
```

## **Customising**

There are 5 customising attributes you can use:

- **data-tooltip-location** - Controls the direction the tooltip will be located in correlation to the element it's assigned to
  - up
  - left
  - right
  - bottom
    - Default: 'up'
  
- **data-tooltip-color** - Controls the tooltip (background) color
  - any HTML/CSS color;
    - Default: 'rgba(59, 72, 80, 0.9)'
    
- **data-tooltip-text-color** - Controls the tooltip's text color
  - any HTML/CSS color;
    - Default: 'white'
    
- **data-tooltip-text-size** - Controls the tooltip's text (font) size
  - size in any HTML/CSS font size unit;
    - Default: '14px'
    
- **data-tooltip-speed** - Controls how fast will the tooltip show up when hovered over
  - time in seconds (s) or miliseconds (ms);
    - Default: '0.3s'
