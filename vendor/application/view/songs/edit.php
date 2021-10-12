<div class="container">
    <h2>You are in the View: application/view/song/edit.php (everything in this box comes from that file)</h2>
    <!-- add song form -->
    <div>
        <h3>Edit a song</h3>
        <form action="<?php echo URL; ?>songs/updatesong" method="POST">
            <label>Professionnels</label>
            
            <label>Nom</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($song->nom, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>Link</label>
            <input type="text" name="prenom" value="<?php echo htmlspecialchars($song->prenom, ENT_QUOTES, 'UTF-8'); ?>" />
            
            <input type="submit" name="submit_update_song" value="Update" />
        </form>
    </div>
</div>

