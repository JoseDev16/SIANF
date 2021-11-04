Route::get('/ComposicionMaterial', [ComposicionMaterialController::class, 'index'])->name('composicion.index');
    Route::post('/ComposicionMaterial/nueva', [ComposicionMaterialController::class, 'store'])->name('composicion.store');
    Route::get('/ComposicionMaterial/edit/{id}', [ComposicionMaterialController::class, 'edit_view'])->name('composicion.edit_view');
    Route::post('/ComposicionMaterial/edit', [ComposicionMaterialController::class, 'edit'])->name('composicion.edit');
    Route::delete('/ComposicionMaterial/delete', [ComposicionMaterialController::class, 'destroy'])->name('composicion.destroy');
