<style>
h2{
    margin: 0;
    padding: 0;
}



</style>
<div id="lista">
{foreach $natjecaji as $n}
    <h2><a href="natjecaj.php?id={$n->id}">{$n->naziv}</a></h2><br>
{/foreach}
</div>