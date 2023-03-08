### HTML Element wrapper for FreshRSS

This extension will add `<div>` wrapper around the feed entry with domain as the class name. For example for the feed `https://google.com/rss` this will create following wrapper:

```
<div class="google_com c_big_companies c_id_1">... entry ...</div>
```

It might be helpful when you want to create custom CSS/JS depending on the feed.

## You can select it by the domain:
```css
.google_com {
    color: #ffffff;
}
```

This will apply styles to the feed details only from given domain.

## You can select it by the category name with c_* prefix:
```css
.c_big_companies {
    color: #ffffff;
}
```
This will apply styles to all feeds details in given category name. The rule is simple here - spaces are replaced with _ and the whole thing is lower-cased.

## Alternatively you can select it by category id with c_id_* prefix:
```css
.c_id_1 {
    color: #ffffff;
}
```
