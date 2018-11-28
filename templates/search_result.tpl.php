<table cellpadding="5" cellspacing="1" class="SearchResult">
    <tr>
        <th>Email</th>
        <th>Name</th>
    </tr>
    <?php
    foreach ($arrSearchData as $val)
    {
        ?>
            <tr>
                <td>
                    <?php echo $val['email']; ?>
                </td>
                <td>
                    <?php echo $val['name']; ?>
                </td>
            </tr>
        <?php
    }
    ?>
</table>