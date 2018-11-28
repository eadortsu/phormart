<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('partials/_emoji_reaction_item', ['reactions' => $reactions, 'reaction' => 'like']); ?>

<?php $this->load->view('partials/_emoji_reaction_item', ['reactions' => $reactions, 'reaction' => 'dislike']); ?>

<?php $this->load->view('partials/_emoji_reaction_item', ['reactions' => $reactions, 'reaction' => 'love']); ?>

<?php $this->load->view('partials/_emoji_reaction_item', ['reactions' => $reactions, 'reaction' => 'funny']); ?>

<?php $this->load->view('partials/_emoji_reaction_item', ['reactions' => $reactions, 'reaction' => 'angry']); ?>

<?php $this->load->view('partials/_emoji_reaction_item', ['reactions' => $reactions, 'reaction' => 'sad']); ?>

<?php $this->load->view('partials/_emoji_reaction_item', ['reactions' => $reactions, 'reaction' => 'wow']); ?>


