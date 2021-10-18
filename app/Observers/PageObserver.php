<?php

namespace App\Observers;

use App\Models\Pages;

class PageObserver
{
	/**
	 * Handle the Page "creating" event.
	 *
	 * @param  \App\Page  $page
	 * @return void
	 */
	public function creating(Page $page)
	{
		if (is_null($page->order)) {
			$page->order = Pages::max('order') + 1;
			return;
		}

		$lowerPriorityCategories = Page::where('order', '>=', $page->order)
			->get();

		foreach ($lowerPriorityCategories as $lowerPriorityPage) {
			$lowerPriorityPage->order++;
			$lowerPriorityPage->saveQuietly();
		}
	}

	/**
	 * Handle the Page "updating" event.
	 *
	 * @param  \App\Page  $page
	 * @return void
	 */
	public function updating(Page $page)
	{
		if ($page->isClean('order')) {
			return;
		}

		if (is_null($page->order)) {
			$page->order = Page::max('order');
		}

		if ($page->getOriginal('order') > $page->order) {
			$orderRange = [
				$page->order, $page->getOriginal('order')
			];
		} else {
			$orderRange = [
				$page->getOriginal('order'), $page->order
			];
		}

		$lowerPriorityCategories = Page::where('id', '!=', $page->id)
			->whereBetween('order', $orderRange)
			->get();

		foreach ($lowerPriorityCategories as $lowerPriorityPage) {
			if ($page->getOriginal('order') < $page->order) {
				$lowerPriorityPage->order--;
			} else {
				$lowerPriorityPage->order++;
			}
			$lowerPriorityPage->saveQuietly();
		}
	}

	/**
	 * Handle the Page "deleted" event.
	 *
	 * @param  \App\Page  $page
	 * @return void
	 */
	public function deleted(Page $page)
	{
		$lowerPriorityCategories = Page::where('order', '>', $page->order)
			->get();

		foreach ($lowerPriorityCategories as $lowerPriorityPage) {
			$lowerPriorityPage->order--;
			$lowerPriorityPage->saveQuietly();
		}
	}
}
